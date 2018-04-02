<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\DataProcessing;

use BK2K\BootstrapPackage\Utility\LanguageUtility;
use TYPO3\CMS\Frontend\DataProcessing\MenuProcessor;

/**
 * This menu processor utilizes HMENU to generate a json encoded menu
 * string that will be decoded again and assigned to FLUIDTEMPLATE as
 * variable. Additional DataProcessing is supported and will be applied
 * to each record.
 *
 * Options:
 * as - The variable to be used within the result
 *
 * See HMENU docs for more options.
 * https://docs.typo3.org/typo3cms/TyposcriptReference/ContentObjects/Hmenu/Index.html
 *
 *
 * Example TypoScript configuration:
 *
 * 10 = TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor
 * 10 {
 *   as = languagenavigation
 *   dataProcessing {
 *     10 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
 *     10 {
 *        references.fieldName = media
 *     }
 *   }
 * }
 */
class LanguageMenuProcessor extends DataProcessorInterface
{
    const LINK_PLACEHOLDER = '###LINKPLACEHOLDER###';
    const TARGET_PLACEHOLDER = '###TARGETPLACEHOLDER###';

    /**
     * The content object renderer
     *
     * @var ContentObjectRenderer
     */
    public $cObj;

    /**
     * The processor configuration
     *
     * @var array
     */
    protected $processorConfiguration;

    /**
     * Allowed configuration keys for menu generation, other keys
     * will throw an exception to prevent configuration errors.
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
        'alternativeSortingField',
        'alternativeSortingField.',
        'excludeUidList',
        'excludeUidList.',
        'excludeDoktypes',
        'includeNotInMenu',
        'alwaysActivePIDlist',
        'alwaysActivePIDlist.',
        'protectLvar',
        'addQueryString',
        'addQueryString.',
        'if',
        'if.',
        'as',
        'dataProcessing',
        'dataProcessing.'
    ];

    /**
     * Remove keys from configuration that should not be passed
     * to HMENU to prevent configuration errors
     *
     * @var array
     */
    public $removeConfigurationKeysForHmenu = [
        'as',
        'dataProcessing',
        'dataProcessing.'
    ];

    /**
     * @var array
     */
    protected $menuConfig = [
        'wrap' => '[|]'
    ];

    /**
     * @var array
     */
    protected $menuLevelConfig = [
        'doNotLinkIt' => '1',
        'wrapItemAndSub' => '{|}, |*| {|}, |*| {|}',
        'stdWrap.' => [
            'cObject' => 'COA',
            'cObject.' => [
                '10' => 'LOAD_REGISTER',
                '10.' => [
                    'languageUid.' => [
                        'cObject' => 'TEXT',
                        'cObject.' => [
                            'value' => '', // Will be set by prepareConfiguration
                            'listNum.' => [
                                'stdWrap.' => [
                                    'data' => 'register:count_HMENU_MENUOBJ',
                                    'wrap' => '|-1'
                                ],
                                'splitChar' => ','
                            ]
                        ]
                    ]
                ],
                '20' => 'USER',
                '20.' => [
                    'userFunc' => 'TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor->getFieldAsJson',
                    'language.' => [
                        'data' => 'register:languageUid'
                    ],
                    'field' => 'title',
                    'stdWrap.' => [
                        'wrap' => '"title":|'
                    ]
                ],
                '21' => 'TEXT',
                '21.' => [
                    'value' => self::LINK_PLACEHOLDER,
                    'wrap' => ',"link":|',
                ],
                '22' => 'TEXT',
                '22.' => [
                    'value' => self::TARGET_PLACEHOLDER,
                    'wrap' => ',"target":|',
                ],
                '30' => 'TEXT',
                '30.' => [
                    'value' => '0',
                    'wrap' => ',"active":|'
                ],
                '40' => 'TEXT',
                '40.' => [
                    'value' => '0',
                    'wrap' => ',"current":|'
                ],
                '50' => 'TEXT',
                '50.' => [
                    'value' => '1',
                    'wrap' => ',"available":|'
                ],
                '60' => 'TEXT',
                '60.' => [
                    'stdWrap.' => [
                        'data' => 'register:languageUid'
                    ],
                    'wrap' => ',"languageUid":"|"'
                ],
                '70' => 'USER',
                '70.' => [
                    'userFunc' => 'TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor->getFieldAsJson',
                    'language.' => [
                        'data' => 'register:languageUid'
                    ],
                    'field' => 'nav_title',
                    'stdWrap.' => [
                        'wrap' => ',"navigationTitle":|'
                    ]
                ],
                '71' => 'USER',
                '71.' => [
                    'userFunc' => 'TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor->getFieldAsJson',
                    'language.' => [
                        'data' => 'register:languageUid'
                    ],
                    'field' => 'language',
                    'stdWrap.' => [
                        'wrap' => ',"language":|'
                    ]
                ],
                '72' => 'USER',
                '72.' => [
                    'userFunc' => 'TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor->getFieldAsJson',
                    'language.' => [
                        'data' => 'register:languageUid'
                    ],
                    'field' => 'locale',
                    'stdWrap.' => [
                        'wrap' => ',"locale":|'
                    ]
                ],
                '80' => 'USER',
                '80.' => [
                    'userFunc' => 'TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor->getFieldAsJson',
                    'language.' => [
                        'data' => 'register:languageUid'
                    ],
                    'field' => 'hreflang',
                    'stdWrap.' => [
                        'wrap' => ',"hreflang":|'
                    ]
                ],
                '81' => 'USER',
                '81.' => [
                    'userFunc' => 'TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor->getFieldAsJson',
                    'language.' => [
                        'data' => 'register:languageUid'
                    ],
                    'field' => 'direction',
                    'stdWrap.' => [
                        'wrap' => ',"direction":|'
                    ]
                ],
                '99' => 'RESTORE_REGISTER'
            ]
        ]
    ];

    /**
     * @var array
     */
    public $menuDefaults = [
        'as' => 'languagemenu'
    ];

    /**
     * @var string
     */
    protected $menuAlternativeSortingField;

    /**
     * @var string
     */
    protected $menuTargetVariableName;

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
     * Get configuration value from processorConfiguration
     *
     * @param string $key
     * @return string
     */
    protected function getConfigurationValue($key)
    {
        return $this->cObj->stdWrapValue($key, $this->processorConfiguration, $this->menuDefaults[$key]);
    }

    /**
     * Gets the data field for the language submitted in $conf in JSON format
     *
     * @param string Empty string (no content to process)
     * @param array TypoScript configuration
     * @return string JSON encoded data
     */
    public function getFieldAsJson($content, $conf)
    {
        $result = '';

        // Support of stdWrap
        if (isset($conf['language.'])) {
            $conf['language'] = $this->cObj->stdWrap($conf['language'], $conf['language.']);
        }
        if (isset($conf['field.'])) {
            $conf['field'] = $this->cObj->stdWrap($conf['field'], $conf['field.']);
        }

        if (isset($conf['language']) && isset($conf['field'])) {
            $row = LanguageUtility::getLanguage($conf['language']);
            if (isset($row[$conf['field']])) {
                $result = $this->jsonEncode($row[$conf['field']]);
            } 
        }

        return $result;
    }

    /**
     * Validate configuration
     *
     * @throws \InvalidArgumentException
     */
    public function validateConfiguration()
    {
        $invalidArguments = [];
        foreach ($this->processorConfiguration as $key => $value) {
            if (!in_array($key, $this->allowedConfigurationKeys)) {
                $invalidArguments[str_replace('.', '', $key)] = $key;
            }
        }
        if (!empty($invalidArguments)) {
            throw new \InvalidArgumentException('MenuProcessor Configuration contains invalid Arguments: ' . implode(', ', $invalidArguments), 1478806566);
        }
    }

    /**
     * Prepare Configuration
     */
    public function prepareConfiguration()
    {
        $this->menuConfig += $this->processorConfiguration;
        // Filter configuration
        foreach ($this->menuConfig as $key => $value) {
            if (in_array($key, $this->removeConfigurationKeysForHmenu)) {
                unset($this->menuConfig[$key]);
            }
        }
        // Process languages
        if (!isset($this->menuConfig['languages']) && !isset($this->menuConfig['languages.'])) {
            // todo: add sites support
            $this->menuConfig['languages.'] = [
                'cObject' => 'COA',
                'cObject.' => [
                    'wrap' => '0|',
                    '10' => 'CONTENT',
                    '10.' => [
                        'table' => 'sys_language',
                        'select.' => [
                            'pidInList' => 'root',
                            'orderBy' => 'sorting'
                        ],
                        'renderObj' => 'TEXT',
                        'renderObj.' => [
                            'wrap' => ',|',
                            'field' => 'uid'
                        ]
                    ]
                ]
            ];
        }
        if (isset($this->menuConfig['languages.'])) {
            $this->menuConfig['languages'] = $this->cObj->stdWrap($this->menuConfig['languages'], $this->menuConfig['languages.']);
            unset($this->menuConfig['languages.']);
        }
        $this->menuLevelConfig['stdWrap.']['cObject.']['10.']['languageUid.']['cObject.']['value'] = $this->menuConfig['languages'];
    }

    /**
     * Build the menu configuration so it can be treated by HMENU cObject
     */
    public function buildConfiguration()
    {
        $i = 1;
        $this->menuConfig[$i] = 'TMENU';
        $this->menuConfig[$i . '.']['IProcFunc'] = 'TYPO3\CMS\Frontend\DataProcessing\MenuProcessor->replacePlaceholderInRenderedMenuItem';
        $this->menuConfig[$i . '.']['alternativeSortingField'] = $this->menuAlternativeSortingField;
        $this->menuConfig[$i . '.']['NO'] = '1';
        $this->menuConfig[$i . '.']['NO.'] = $this->menuLevelConfig;
        $this->menuConfig[$i . '.']['IFSUB'] = '1';
        $this->menuConfig[$i . '.']['IFSUB.'] = $this->menuConfig[$i . '.']['NO.'];
        $this->menuConfig[$i . '.']['ACT'] = '1';
        $this->menuConfig[$i . '.']['ACT.'] = $this->menuConfig[$i . '.']['NO.'];
        $this->menuConfig[$i . '.']['ACT.']['stdWrap.']['cObject.']['30.']['value'] = '1';
        $this->menuConfig[$i . '.']['ACTIFSUB'] = '1';
        $this->menuConfig[$i . '.']['ACTIFSUB.'] = $this->menuConfig[$i . '.']['ACT.'];
        $this->menuConfig[$i . '.']['CUR'] = '1';
        $this->menuConfig[$i . '.']['CUR.'] = $this->menuConfig[$i . '.']['ACT.'];
        $this->menuConfig[$i . '.']['CUR.']['stdWrap.']['cObject.']['40.']['value'] = '1';
        $this->menuConfig[$i . '.']['CURIFSUB'] = '1';
        $this->menuConfig[$i . '.']['CURIFSUB.'] = $this->menuConfig[$i . '.']['CUR.'];
        $this->menuConfig[$i . '.']['USERDEF1'] = $this->menuConfig[$i . '.']['NO'];
        $this->menuConfig[$i . '.']['USERDEF1.'] = $this->menuConfig[$i . '.']['NO.'];
        $this->menuConfig[$i . '.']['USERDEF1.']['stdWrap.']['cObject.']['60.']['value'] = '0';
        $this->menuConfig[$i . '.']['USERDEF2'] = $this->menuConfig[$i . '.']['ACT'];
        $this->menuConfig[$i . '.']['USERDEF2.'] = $this->menuConfig[$i . '.']['ACT.'];
        $this->menuConfig[$i . '.']['USERDEF2.']['stdWrap.']['cObject.']['60.']['value'] = '0';
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
        $this->processorConfiguration = $processorConfiguration;

        // Get Configuration
        $this->menuTargetVariableName = $this->getConfigurationValue('as');
        $this->menuAlternativeSortingField = $this->getConfigurationValue('alternativeSortingField');

        // Validate Configuration
        $this->validateConfiguration();

        // Build Configuration
        $this->prepareConfiguration();
        $this->buildConfiguration();

        // Process Configuration
        $menuContentObject = $cObj->getContentObject('HMENU');
        $renderedMenu = $menuContentObject->render($this->menuConfig);
        if (!$renderedMenu) {
            return $processedData;
        }

        // Process menu
        $menu = json_decode($renderedMenu, true);
        $processedMenu = [];

        foreach ($menu as $key => $page) {
            $processedMenu[$key] = $this->processAdditionalDataProcessors($page, $processorConfiguration);
        }

        // Return processed data
        $processedData[$this->menuTargetVariableName] = $processedMenu;
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
        return $this->jsonEncode($this->cObj->data);
    }

    /**
     * This UserFunc encodes the content as Json
     *
     * @param string $content
     * @param array $conf
     * @return string JSON encoded content
     */
    public function jsonEncodeUserFunc($content, $conf)
    {
        $content = $this->jsonEncode($content);
        return $content;
    }

    /**
     * JSON Encode
     *
     * @param mixed $value
     * @return string
     */
    public function jsonEncode($value)
    {
        return json_encode($value, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    }

    /**
     * This UserFunc gets the link and the target
     *
     * @param array $menuItem
     * @param array $conf
     */
    public function replacePlaceholderInRenderedMenuItem($menuItem, $conf)
    {
        $link = $this->jsonEncode($menuItem['linkHREF']['HREF']);
        $target = $this->jsonEncode($menuItem['linkHREF']['TARGET']);

        $menuItem['parts']['title'] = str_replace(self::LINK_PLACEHOLDER, $link, $menuItem['parts']['title']);
        $menuItem['parts']['title'] = str_replace(self::TARGET_PLACEHOLDER, $target, $menuItem['parts']['title']);

        return $menuItem;
    }
}
