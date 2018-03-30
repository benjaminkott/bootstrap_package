<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\DataProcessing;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentDataProcessor;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
use TYPO3\CMS\Frontend\DataProcessing\MenuProcessor;
use BK2K\BootstrapPackage\Utility\LanguageUtility;

/**
 * This menu processor utilizes HMENU to generate a json encoded menu
 * string that will be decoded again and assigned to FLUIDTEMPLATE as
 * variable. Additional DataProcessing is supported and will be applied
 * to each record.
 *
 * Options:
 * as - The variable to be used within the result
 * levels - Number of levels of the menu
 * expandAll = If false, submenus will only render if the parent page is active
 * includeSpacer = If true, pagetype spacer will be included in the menu
 * titleField = Field that should be used for the title
 *
 * See HMENU docs for more options.
 * https://docs.typo3.org/typo3cms/TyposcriptReference/ContentObjects/Hmenu/Index.html
 *
 *
 * Example TypoScript configuration:
 *
 * 10 = BK2K\BootstrapPackage\DataProcessing\LanguageMenuProcessor
 * 10 {
 *   as = languagenavigation
 *   expandAll = 1
 *   includeSpacer = 1
 *   dataProcessing {
 *     10 = TYPO3\CMS\Frontend\DataProcessing\FilesProcessor
 *     10 {
 *        references.fieldName = media
 *     }
 *   }
 * }
 */
class LanguageMenuProcessor extends MenuProcessor
{
    /**
     * Gets the language data for the languageUid
     *
     * @param int $languageUid
     * @return string JSON encoded data
     */
    protected function getLanguageData($languageUid)
    {
        return LanguageUtility::getLanguageData($languageUid);
    }

    /**
     * Executes stdWrap on global properties
     *
     * @param array $conf
     */
    protected function stdWrap(&$conf)
    {
        if (isset($conf['languageUid.'])) {
            $conf['languageUid'] = $this->cObj->stdWrap($conf['languageUid'], $conf['languageUid.']);
        }
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        unset($this->menuLevelConfig['stdWrap.']['cObject.']['10']);
        unset($this->menuLevelConfig['stdWrap.']['cObject.']['10.']);
        $this->menuDefaults['as'] = 'languagemenu';
        $this->menuDefaults['titleField'] = '';
    }

    /**
     * Add loading from sys_languages in case special.value is not set
     *
     * @throws \InvalidArgumentException
     */
    public function validateConfiguration()
    {
        $this->processorConfiguration = array_replace_recursive(
            [
                'special' => 'language',
                'special.' => [
                    'value.' => [
                        'ifBlank.' => [
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
                        ]
                    ]
                ]
            ],
            $this->processorConfiguration
        );

        parent::validateConfiguration();
    }

    /**
     * Add more language properties
     */
    public function prepareLevelLanguageConfiguration()
    {
        parent::prepareLevelLanguageConfiguration();

        if ($this->menuConfig['special'] === 'language') {
            $this->menuLevelConfig['stdWrap.']['cObject.'] = [
                '1' => 'LOAD_REGISTER',
                '1.' => [
                    'languageUid.' => [
                        'cObject' => 'TEXT',
                        'cObject.' => [
                            'value' => $this->menuConfig['special.']['value'],
                            'listNum.' => [
                                'stdWrap.' => [
                                    'data' => 'register:count_HMENU_MENUOBJ',
                                    'wrap' => '|-1'
                                ],
                                'splitChar' => ','
                            ]
                        ]
                    ]
                ]
            ] + $this->menuLevelConfig['stdWrap.']['cObject.'];

            $this->menuLevelConfig['stdWrap.']['cObject.'] = array_replace_recursive(
                $this->menuLevelConfig['stdWrap.']['cObject.'],
                [
                    '20' => 'USER',
                    '20.' => [
                        'userFunc' => 'TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor->getLanguageTitleAsJson',
                        'languageUid.' => [
                            'data' => 'register:languageUid'
                        ],
                        'stdWrap.' => [
                            'wrap' => '"title":|'
                        ]
                    ],
                    '70.' => [
                        'stdWrap.' => [
                            'data' => 'register:languageUid'
                        ],
                        'wrap' => ',"languageUid":"|"'
                    ],
                    '71' => 'USER',
                    '71.' => [
                        'userFunc' => 'TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor->getLanguageAsJson',
                        'languageUid.' => [
                            'data' => 'register:languageUid'
                        ],
                        'stdWrap.' => [
                            'wrap' => '"language":|'
                        ]
                    ],
                    '72' => 'USER',
                    '72.' => [
                        'userFunc' => 'TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor->getLocaleAsJson',
                        'languageUid.' => [
                            'data' => 'register:languageUid'
                        ],
                        'stdWrap.' => [
                            'wrap' => '"locale":|'
                        ]
                    ],
                    '73' => 'USER',
                    '73.' => [
                        'userFunc' => 'TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor->getHreflangAsJson',
                        'languageUid.' => [
                            'data' => 'register:languageUid'
                        ],
                        'stdWrap.' => [
                            'wrap' => '"hreflang":|'
                        ]
                    ],
                    '74' => 'USER',
                    '74.' => [
                        'userFunc' => 'TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor->getDirectionAsJson',
                        'languageUid.' => [
                            'data' => 'register:languageUid'
                        ],
                        'stdWrap.' => [
                            'wrap' => '"direction":|'
                        ]
                    ],
                    '99' => 'RESTORE_REGISTER'
                ]
            );
        }
    }

    /**
     * Gets the language title for the language id submitted as conf in JSON format
     *
     * @param string Empty string (no content to process)
     * @param array TypoScript configuration
     * @return string JSON encoded data
     * 
     * @param  string          Empty string (no content to process)
     * @param  array           TypoScript configuration
     * @return string          HTML output, showing content elements (in reverse order, if configured)
     */
    public function getLanguageTitleAsJson($content, $conf)
    {
        $result = $this->jsonEncode('empty');
        $this->stdWrap($conf);
        if (isset($conf['languageUid'])) {
            $result = $this->jsonEncode($this->getLanguageData($conf['languageUid'])['title']);
        }
        return $result;
    }

    /**
     * Gets the language for the language id submitted as conf in JSON format
     *
     * @param string $content
     * @param array $conf
     * @return string JSON encoded data
     */
    public function getLanguageAsJson($content, $conf)
    {
        $result = '';
        $this->stdWrap($conf);
        if (isset($conf['languageUid'])) {
            $result = $this->jsonEncode($this->getLanguageData($conf['languageUid'])['language']);
        }
        return $result;
    }

    /**
     * Gets the locale for the language id submitted as conf in JSON format
     *
     * @param string $content
     * @param array $conf
     * @return string JSON encoded data
     */
    public function getLocaleAsJson($content, $conf)
    {
        $result = '';
        $this->stdWrap($conf);
        if (isset($conf['languageUid'])) {
            $result = $this->jsonEncode($this->getLanguageData($conf['languageUid'])['local']);
        }
        return $result;
    }

    /**
     * Gets the hreflang for the language id submitted as conf in JSON format
     *
     * @param string $content
     * @param array $conf
     * @return string JSON encoded data
     */
    public function getHreflangAsJson($content, $conf)
    {
        $result = '';
        $this->stdWrap($conf);
        if (isset($conf['languageUid'])) {
            $result = $this->jsonEncode($this->getLanguageData($conf['languageUid'])['hreflang']);
        }
        return $result;
    }

    /**
     * Gets the direction for the language id submitted as conf in JSON format
     *
     * @param string $content
     * @param array $conf
     * @return string JSON encoded data
     */
    public function getDirectionAsJson($content, $conf)
    {
        $result = '';
        $this->stdWrap($conf);
        if (isset($conf['languageUid'])) {
            $result = $this->jsonEncode($this->getLanguageData($conf['languageUid'])['direction']);
        }
        return $result;
    }
}
