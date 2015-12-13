<?php
namespace BK2K\BootstrapPackage\DataProcessing;

/*
 *  The MIT License (MIT)
 *
 *  Copyright (c) 2015 Benjamin Kott, http://www.bk2k.info
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in
 *  all copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *  THE SOFTWARE.
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentDataProcessor;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * This menu processor utilizes HMENU to generate a json encoded menu
 * string that will be decoded again and assigned to FLUIDTEMPLATE as
 * variable. Additional DataProcessing is supported and will be applied
 * to each record.
 *
 * Options:
 * as - The variable to be used within the result
 * levels - Number of levels of the menu
 *
 * See HMENU docs for more options.
 * https://docs.typo3.org/typo3cms/TyposcriptReference/ContentObjects/Hmenu/Index.html
 *
 *
 * Example TypoScript configuration:
 *
 * 10 = BK2K\BootstrapPackage\DataProcessing\FlexFormProcessor
 * 10 {
 *   special = list
 *   special.value.field = pages
 *   levels = 7
 *   as = menu
 *   dataProcessing {
 *    10 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
 *    10 {
 *        references.fieldName = media
 *      }
 *    }
 *  }
 *
 */
class MenuProcessor implements DataProcessorInterface
{
    /**
     * Allowed configuration keys for menu generation, other keys will be
     * ignored to prevent configuration errors.
     *
     * @var array
     */
    public $allowedConfigurationKeys = [
        'cache_period',
        'entryLevel',
        'entryLevel.',
        'special',
        'special.',
        'minItems',
        'minItems.',
        'maxItems',
        'maxItems.',
        'begin',
        'begin.',
        'excludeUidList',
        'excludeUidList.',
        'excludeDoktypes',
        'includeNotInMenu',
        'alwaysActivePIDlist',
        'alwaysActivePIDlist.',
        'protectLvar',
        'if',
        'if.',
    ];

    /**
     * @var ContentObjectRenderer
     */
    public $cObj;

    /**
     * @var ContentDataProcessor
     */
    protected $contentDataProcessor;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contentDataProcessor = GeneralUtility::makeInstance(ContentDataProcessor::class);
    }

    /**
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData)
    {
        $this->cObj = $cObj;
        $conf = array();

        // Filter configuration
        foreach ($processorConfiguration as $key => $value) {
            if (in_array($key, $this->allowedConfigurationKeys)) {
                $conf[$key] = $value;
            }
        }

        // Process value
        if (isset($conf['special.']['value.'])) {
            $conf['special.']['value'] = $this->cObj->stdWrap($conf['special.']['value'], $conf['special.']['value.']);
            unset($conf['special.']['value.']);
        }

        // Default Configuration
        $conf['wrap'] = '[|]';

        $rendering = [
            'doNotLinkIt' => '1',
            'wrapItemAndSub' => '{|}, |*| {|}, |*| {|}',
            'stdWrap.' => [
                'cObject' => 'COA',
                'cObject.' => [
                    '1' => 'USER',
                    '1.' => [
                        'userFunc' => 'BK2K\BootstrapPackage\DataProcessing\MenuProcessor->getDataAsJson',
                        'stdWrap.' => [
                            'wrap' => '"data":|'
                        ]
                    ],
                    '2' => 'TEXT',
                    '2.' => [
                        'value' => '0',
                        'wrap' => ',"active":|'
                    ],
                    '3' => 'TEXT',
                    '3.' => [
                        'value' => '0',
                        'wrap' => ',"current":|'
                    ]
                ]
            ]
        ];
        if ($conf['special'] == 'language') {
            $rendering['stdWrap.']['cObject.'] = array_replace_recursive(
                $rendering['stdWrap.']['cObject.'],
                [
                    '4' => 'TEXT',
                    '4.' => [
                        'value' => '1',
                        'wrap' => ',"available":|'
                    ],
                    '5' => 'TEXT',
                    '5.' => [
                        'value' => $conf['special.']['value'],
                        'listNum.' => [
                            'stdWrap.' => [
                                'data' => 'register:count_HMENU_MENUOBJ',
                                'wrap' => '|-1'
                            ],
                            'splitChar' => ','
                        ],
                        'wrap' => ',"languageUid":|'
                    ]
                ]
            );
        }

        // Menu levels
        $menuLevels = (int)$cObj->stdWrapValue('levels', $processorConfiguration, 1);
        if ($menuLevels === 0) {
            $menuLevels = 1;
        }

        // Menu configuration
        for ($i = 1; $i <= $menuLevels; $i++) {
            $conf[$i] = 'TMENU';
            if ($i > 1) {
                $conf[$i . '.']['stdWrap.']['wrap'] = ',"children": [|]';
            }
            $conf[$i . '.']['expAll'] = '1';
            $conf[$i . '.']['NO'] = '1';
            $conf[$i . '.']['NO.'] = $rendering;
            $conf[$i . '.']['IFSUB'] = '1';
            $conf[$i . '.']['IFSUB.'] = $conf[$i . '.']['NO.'];
            $conf[$i . '.']['ACT'] = '1';
            $conf[$i . '.']['ACT.'] = $conf[$i . '.']['NO.'];
            $conf[$i . '.']['ACT.']['stdWrap.']['cObject.']['2.']['value'] = '1';
            $conf[$i . '.']['ACTIFSUB'] = '1';
            $conf[$i . '.']['ACTIFSUB.'] = $conf[$i . '.']['ACT.'];
            $conf[$i . '.']['CUR'] = '1';
            $conf[$i . '.']['CUR.'] = $conf[$i . '.']['ACT.'];
            $conf[$i . '.']['CUR.']['stdWrap.']['cObject.']['3.']['value'] = '1';
            $conf[$i . '.']['CURIFSUB'] = '1';
            $conf[$i . '.']['CURIFSUB.'] = $conf[$i . '.']['CUR.'];
            if ($conf['special'] == 'language') {
                $conf[$i . '.']['USERDEF1'] = $conf[$i . '.']['NO'];
                $conf[$i . '.']['USERDEF1.'] = $conf[$i . '.']['NO.'];
                $conf[$i . '.']['USERDEF1.']['stdWrap.']['cObject.']['4.']['value'] = '0';
                $conf[$i . '.']['USERDEF2'] = $conf[$i . '.']['ACT'];
                $conf[$i . '.']['USERDEF2.'] = $conf[$i . '.']['ACT.'];
                $conf[$i . '.']['USERDEF2.']['stdWrap.']['cObject.']['4.']['value'] = '0';
            }
        }
        $menuContentObject = $cObj->getContentObject('HMENU');
        $renderedMenu = $menuContentObject->render($conf);
        $menu = json_decode($renderedMenu, true);

        // Process menu
        $processedMenu = array();
        foreach ($menu as $key => $page) {
            $processedMenu[$key] = $this->processAdditionalDataProcessors($page, $processorConfiguration);
        }

        // The variable to be used within the result
        $targetVariableName = $cObj->stdWrapValue('as', $processorConfiguration, 'menu');

        // Return processed data
        $processedData[$targetVariableName] = $processedMenu;
        return $processedData;
    }

    /**
     * Process additional data processors
     *
     * @param array $page
     * @param array $processorConfiguration
     */
    protected function processAdditionalDataProcessors($page, $processorConfiguration)
    {
        if (is_array($page['children'])) {
            foreach ($page['children'] as $key => $item) {
                $page['children'][$key] = $this->processAdditionalDataProcessors($item, $processorConfiguration);
            }
        }
        /** @var ContentObjectRenderer $recordContentObjectRenderer */
        $recordContentObjectRenderer = GeneralUtility::makeInstance(ContentObjectRenderer::class);
        $recordContentObjectRenderer->start($page['data'], 'pages');
        $processedPage = $this->contentDataProcessor->process($recordContentObjectRenderer, $processorConfiguration, $page);
        return $processedPage;
    }

    /**
     * Gets the data of the current record in JSON format
     *
     * @return string JSON encoded data
     */
    public function getDataAsJson()
    {
        return json_encode($this->cObj->data);
    }
}
