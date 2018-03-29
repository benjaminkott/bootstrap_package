<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\DataProcessing;

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
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->menuDefaults['as'] = 'languagemenu';
        $this->menuDefaults['titleField'] = '';
    }

    /**
     * Validate configuration
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
     * Prepare the configuration when rendering a language menu
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
     * Gets the data of the current record in JSON format
     *
     * @param string $content
     * @param array $conf
     * @return string JSON encoded data
     */
    public function getLanguageTitleAsJson($content, $conf)
    {
        return $this->jsonEncode($this->cObj->data);
    }

    /**
     * Gets the data of the current record in JSON format
     *
     * @param string $content
     * @param array $conf
     * @return string JSON encoded data
     */
    public function getLanguageAsJson($content, $conf)
    {
        return $this->jsonEncode($this->cObj->data);
    }

    /**
     * Gets the data of the current record in JSON format
     *
     * @param string $content
     * @param array $conf
     * @return string JSON encoded data
     */
    public function getLocaleAsJson($content, $conf)
    {
        return $this->jsonEncode($this->cObj->data);
    }

    /**
     * Gets the data of the current record in JSON format
     *
     * @param string $content
     * @param array $conf
     * @return string JSON encoded data
     */
    public function getHreflangAsJson($content, $conf)
    {
        return $this->jsonEncode($this->cObj->data);
    }

    /**
     * Gets the data of the current record in JSON format
     *
     * @param string $content
     * @param array $conf
     * @return string JSON encoded data
     */
    public function getDirectionAsJson($content, $conf)
    {
        return $this->jsonEncode($this->cObj->data);
    }
}
