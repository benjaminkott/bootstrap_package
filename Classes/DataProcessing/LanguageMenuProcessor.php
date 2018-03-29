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
use TYPO3\CMS\Frontend\DataProcessing;


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
     * Gets the value of a TS constant
     *
     * @param int $key
     * @return string Value of the constant
     */
    protected function getConstantValue($key)
    {
        $result = '';
        if (!isset($GLOBALS['TSFE']->tmpl->flatSetup)
            || !is_array($GLOBALS['TSFE']->tmpl->flatSetup)
            || count($GLOBALS['TSFE']->tmpl->flatSetup) === 0) {
            $GLOBALS['TSFE']->tmpl->generateConfig();
        }
        foreach ($GLOBALS['TSFE']->tmpl->flatSetup as $constant => $value) {
            if (strpos($constant, $key) === 0) {
                $result = $value;
                break;
            }
        }
        return $result;
    }

    /**
     * Gets the language data for the languageUid
     *
     * @param int $languageUid
     * @return string JSON encoded data
     */
    protected function getLanguageData($languageUid)
    {
        static $languageData = null;

        /*
        title => 'English', 
        link => '/en/',
        active => 0, 
        current => 0,
        available => 1,
        languageUid => 1,
        language = 'en',
        locale = 'en_GB.UTF-8',
        hreflang = 'en-GB',
        direction = 'ltr'
        */

        if ($languageData === null || !is_array($languageData[$languageUid])) {
            if ($languageUid === 0) {
                $languageData[$languageUid]['title'] = $this->getConstantValue('page.theme.language.defaultTitle');
                $languageData[$languageUid]['language'] = $this->getConstantValue('page.theme.language.defaultLanguage');
                $languageData[$languageUid]['locale'] = $this->getConstantValue('page.theme.language.defaultLocale');
                $languageData[$languageUid]['hreflang'] = $this->getConstantValue('page.theme.language.defaultHreflang');
                $languageData[$languageUid]['direction'] = $this->getConstantValue('page.theme.language.defaultDirection');
            }
            else
            {
                static $queryBuilder = null;

                if ($queryBuilder === null) {
                    $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_language');
                }

                $language = $queryBuilder->select('title', 'language_isocode AS language', 'locale', 'hreflang', 'direction', 'nav_title')
                    ->from('sys_language')
                    ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)))
                    ->execute()
                    ->fetch();

                if (is_array($language)) {
                    $languageData[$languageUid] = $language;

                    if (!empty($languageData[$languageUid][nav_title])) {
                        $languageData[$languageUid]['title'] = $languageData[$languageUid][nav_title];
                    }

                    unset($languageData[$languageUid][nav_title]);
                }
            }
        }

        return $languageData;
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
                    '20.' => [
                        'trim' => '1',
                        'wrap' => ',"title":|',
                        'preUserFunc' => 'BK2K\BootstrapPackage\DataProcessing\LanguageMenuProcessor->getLanguageTitleAsJson',
                        'preUserFunc.' => [
                            'languageUid' => '{register:languageUid}'
                        ],
                    ],
                    '71' => 'USER',
                    '71.' => [
                        'userFunc' => 'BK2K\BootstrapPackage\DataProcessing\LanguageMenuProcessor->getLanguageAsJson',
                        'userFunc.' => [
                            'languageUid' => '{register:languageUid}'
                        ],
                        'stdWrap.' => [
                            'wrap' => '"language":|'
                        ]
                    ],
                    '72' => 'USER',
                    '72.' => [
                        'userFunc' => 'BK2K\BootstrapPackage\DataProcessing\LanguageMenuProcessor->getLocaleAsJson',
                        'userFunc.' => [
                            'languageUid' => '{register:languageUid}'
                        ],
                        'stdWrap.' => [
                            'wrap' => '"locale":|'
                        ]
                    ],
                    '73' => 'USER',
                    '73.' => [
                        'userFunc' => 'BK2K\BootstrapPackage\DataProcessing\LanguageMenuProcessor->getHreflangAsJson',
                        'userFunc.' => [
                            'languageUid' => '{register:languageUid}'
                        ],
                        'stdWrap.' => [
                            'wrap' => '"hreflang":|'
                        ]
                    ],
                    '74' => 'USER',
                    '74.' => [
                        'userFunc' => 'BK2K\BootstrapPackage\DataProcessing\LanguageMenuProcessor->getDirectionAsJson',
                        'userFunc.' => [
                            'languageUid' => '{register:languageUid}'
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
     * @param string $content
     * @param array $conf
     * @return string JSON encoded data
     */
    public function getLanguageTitleAsJson($content, $conf)
    {
        $result = '';
        if (is_array($conf) && !empty($conf['languageUid'])) {
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
        if (is_array($conf) && !empty($conf['languageUid'])) {
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
        if (is_array($conf) && !empty($conf['languageUid'])) {
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
        if (is_array($conf) && !empty($conf['languageUid'])) {
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
        if (is_array($conf) && !empty($conf['languageUid'])) {
            $result = $this->jsonEncode($this->getLanguageData($conf['languageUid'])['direction']);
        }
        return $result;
    }
}
