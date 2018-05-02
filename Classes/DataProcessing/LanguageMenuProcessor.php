<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\DataProcessing;

use BK2K\BootstrapPackage\Utility\LanguageUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentDataProcessor;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * This menu processor generates a json encoded menu string that will be
 * decoded again and assigned to FLUIDTEMPLATE as variable.
 *
 * Options:
 * if        - TypoScript if condition
 * languages - A list of languages id's (e.g. 0,1,2) to use for the menu
 *             creation or 'auto' to load from system or site languages
 * as        - The variable to be used within the result
 *
 * Example TypoScript configuration:
 * 10 = TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor
 * 10 {
 *   as = languagenavigation
 * }
 */
class LanguageMenuProcessor implements DataProcessorInterface
{
    protected const LINK_PLACEHOLDER = '###LINKPLACEHOLDER###';

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
    protected $allowedConfigurationKeys = [
        'if',
        'if.',
        'languages',
        'languages.',
        'as'
    ];

    /**
     * Remove keys from configuration that should not be passed
     * to HMENU to prevent configuration errors
     *
     * @var array
     */
    protected $removeConfigurationKeysForHmenu = [
        'languages',
        'languages.',
        'as'
    ];

    /**
     * @var array
     */
    protected $menuConfig = [
        'special' => 'language',
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
                    'page' => '', // Will be set by prepareConfiguration
                    'stdWrap.' => [
                        'wrap' => '"title":|'
                    ]
                ],
                '21' => 'TEXT',
                '21.' => [
                    'value' => self::LINK_PLACEHOLDER,
                    'wrap' => ',"link":|',
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
                    'field' => 'navigationTitle',
                    'page' => '', // Will be set by prepareConfiguration
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
                    'field' => 'twoLetterIsoCode',
                    'page' => '', // Will be set by prepareConfiguration
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
                    'page' => '', // Will be set by prepareConfiguration
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
                    'page' => '', // Will be set by prepareConfiguration
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
                    'page' => '', // Will be set by prepareConfiguration
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
    protected $menuDefaults = [
        'as' => 'languagemenu'
    ];

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
    protected function getConfigurationValue(string $key): string
    {
        return $this->cObj->stdWrapValue($key, $this->processorConfiguration, $this->menuDefaults[$key]);
    }

    /**
     * Returns the data from the field and language submitted by $conf in JSON format
     *
     * @param string Empty string (no content to process)
     * @param array TypoScript configuration
     * @return string JSON encoded data
     * @throws \InvalidArgumentException
     */
    public function getFieldAsJson(string $content, array $conf): string
    {
        // Support of stdWrap for parameters
        if (isset($conf['language.'])) {
            $conf['language'] = $this->cObj->stdWrap($conf['language'], $conf['language.']);
            unset($conf['language.']);
        }
        if (isset($conf['field.'])) {
            $conf['field'] = $this->cObj->stdWrap($conf['field'], $conf['field.']);
            unset($conf['field.']);
        }
        if (isset($conf['page.'])) {
            $conf['page'] = $this->cObj->stdWrap($conf['page'], $conf['page.']);
            unset($conf['page.']);
        }

        // Check required fields
        if ($conf['language'] === '') {
            throw new \InvalidArgumentException('Argument \'language\' must be supplied.', 1522959186);
        }
        if ($conf['field'] === '') {
            throw new \InvalidArgumentException('Argument \'field\' must be supplied.', 1522795274);
        }
        if ($conf['page'] === '') {
            throw new \InvalidArgumentException('Argument \'page\' must be supplied.', 1523106560);
        }

        $result = '';

        $row = LanguageUtility::getLanguageRow($conf['page'], $conf['language']);
        if (isset($row[$conf['field']])) {
            $result = $this->jsonEncode($row[$conf['field']]);
        }

        return $result;
    }

    /**
     * @throws \InvalidArgumentException
     */
    protected function validateConfiguration()
    {
        $invalidArguments = [];
        foreach ($this->processorConfiguration as $key => $value) {
            if (!in_array($key, $this->allowedConfigurationKeys)) {
                $invalidArguments[str_replace('.', '', $key)] = $key;
            }
        }
        if (!empty($invalidArguments)) {
            throw new \InvalidArgumentException('LanguageMenuProcessor configuration contains invalid arguments: ' . implode(', ', $invalidArguments), 1522959188);
        }
    }

    /**
     * Process languages and filter the configuration
     */
    protected function prepareConfiguration(): void
    {
        $this->menuConfig += $this->processorConfiguration;

        // Process languages
        if (!empty($this->menuConfig['languages.'])) {
            $this->menuConfig['languages'] = $this->cObj->stdWrap($this->menuConfig['languages'], $this->menuConfig['languages.']);
        }

        if ($this->menuConfig['languages'] === 'auto' || empty($this->menuConfig['languages'])) {
            $this->menuConfig['special.']['value'] = LanguageUtility::getLanguageList($GLOBALS['TSFE']->id, $this->menuAlternativeSortingField);
        } else {
            $this->menuConfig['special.']['value'] = $this->menuConfig['languages'];
        }

        $this->menuLevelConfig['stdWrap.']['cObject.']['10.']['languageUid.']['cObject.']['value'] = $this->menuConfig['special.']['value'];

        // Set page id
        $pageId = strval($GLOBALS['TSFE']->id);
        $this->menuLevelConfig['stdWrap.']['cObject.']['20.']['page'] = $pageId;
        $this->menuLevelConfig['stdWrap.']['cObject.']['70.']['page'] = $pageId;
        $this->menuLevelConfig['stdWrap.']['cObject.']['71.']['page'] = $pageId;
        $this->menuLevelConfig['stdWrap.']['cObject.']['72.']['page'] = $pageId;
        $this->menuLevelConfig['stdWrap.']['cObject.']['80.']['page'] = $pageId;
        $this->menuLevelConfig['stdWrap.']['cObject.']['81.']['page'] = $pageId;

        // Filter configuration
        foreach ($this->menuConfig as $key => $value) {
            if (in_array($key, $this->removeConfigurationKeysForHmenu, true)) {
                unset($this->menuConfig[$key]);
            }
        }
    }

    /**
     * Build the menu configuration so it can be treated by HMENU cObject
     */
    protected function buildConfiguration(): void
    {
        $this->menuConfig['1'] = 'TMENU';
        $this->menuConfig['1.']['IProcFunc'] = LanguageMenuProcessor::class . '->replacePlaceholderInRenderedMenuItem';
        $this->menuConfig['1.']['NO'] = '1';
        $this->menuConfig['1.']['NO.'] = $this->menuLevelConfig;
        $this->menuConfig['1.']['ACT'] = '1';
        $this->menuConfig['1.']['ACT.'] = $this->menuConfig['1.']['NO.'];
        $this->menuConfig['1.']['ACT.']['stdWrap.']['cObject.']['30.']['value'] = '1';
        $this->menuConfig['1.']['CUR'] = '1';
        $this->menuConfig['1.']['CUR.'] = $this->menuConfig['1.']['ACT.'];
        $this->menuConfig['1.']['CUR.']['stdWrap.']['cObject.']['40.']['value'] = '1';
        $this->menuConfig['1.']['USERDEF1'] = $this->menuConfig['1.']['NO'];
        $this->menuConfig['1.']['USERDEF1.'] = $this->menuConfig['1.']['NO.'];
        $this->menuConfig['1.']['USERDEF1.']['stdWrap.']['cObject.']['50.']['value'] = '0';
        $this->menuConfig['1.']['USERDEF2'] = $this->menuConfig['1.']['ACT'];
        $this->menuConfig['1.']['USERDEF2.'] = $this->menuConfig['1.']['ACT.'];
        $this->menuConfig['1.']['USERDEF2.']['stdWrap.']['cObject.']['50.']['value'] = '0';
    }

    /**
     * Validate and Build the menu configuration so it can be treated by HMENU cObject
     */
    protected function validateAndBuildConfiguration(): void
    {
        // Validate Configuration
        $this->validateConfiguration();

        // Build Configuration
        $this->prepareConfiguration();
        $this->buildConfiguration();
    }

    /**
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData): array
    {
        $this->cObj = $cObj;
        $this->processorConfiguration = $processorConfiguration;

        // Get Configuration
        $this->menuTargetVariableName = $this->getConfigurationValue('as');

        // Validate and Build Configuration
        $this->validateAndBuildConfiguration();

        // Process Configuration
        $menuContentObject = $cObj->getContentObject('HMENU');
        $renderedMenu = $menuContentObject->render($this->menuConfig);
        if ($renderedMenu) {
            // Process menu
            $menu = json_decode($renderedMenu, true);
            $processedMenu = [];

            foreach ($menu as $key => $language) {
                $processedMenu[$key] = $language;
            }

            $processedData[$this->menuTargetVariableName] = $processedMenu;
        }

        return $processedData;
    }

    /**
     * JSON Encode
     *
     * @param mixed $value
     * @return string
     */
    protected function jsonEncode($value): string
    {
        return json_encode($value, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    }

    /**
     * This UserFunc gets the link and the target
     *
     * @param array $menuItem
     * @return array
     */
    public function replacePlaceholderInRenderedMenuItem(array $menuItem): array
    {
        $link = $this->jsonEncode($menuItem['linkHREF']['HREF']);

        $menuItem['parts']['title'] = str_replace(self::LINK_PLACEHOLDER, $link, $menuItem['parts']['title']);

        return $menuItem;
    }
}
