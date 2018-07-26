<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('lang')) {
    $generalLanguageFile = 'EXT:lang/Resources/Private/Language/locallang_general.xlf';
} else {
    $generalLanguageFile = 'EXT:core/Resources/Private/Language/locallang_general.xlf';
}

return [
    'ctrl' => [
        'label' => 'date',
        'label_alt' => 'header',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:timeline_item',
        'delete' => 'deleted',
        'versioningWS' => true,
        'origUid' => 't3_origuid',
        'hideTable' => true,
        'hideAtCopy' => true,
        'prependAtCopy' => 'LLL:' . $generalLanguageFile . ':LGL.prependAtCopy',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'languageField' => 'sys_language_uid',
        'default_sortby' => 'date',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'typeicon_classes' => [
            'default' => 'content-bootstrappackage-timeline-item'
        ],
    ],
    'interface' => [
        'showRecordFieldList' => '
            hidden,
            tt_content,
            header
        ',
    ],
    'types' => [
        '1' => [
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                date,
                header,
                bodytext,
                icon_file,
                image,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --palette--;;hiddenLanguagePalette,
            '
        ],
    ],
    'palettes' => [
        '1' => [
            'showitem' => ''
        ],
        'access' => [
            'showitem' => '
                starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,
                endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel
            '
        ],
        'general' => [
            'showitem' => '
                tt_content
            '
        ],
        'visibility' => [
            'showitem' => '
                hidden;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:timeline_item
            '
        ],
        // hidden but needs to be included all the time, so sys_language_uid is set correctly
        'hiddenLanguagePalette' => [
            'showitem' => 'sys_language_uid, l10n_parent',
            'isHiddenPalette' => true,
        ],
    ],
    'columns' => [
        'tt_content' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:timeline_item.tt_content',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tt_content',
                'foreign_table_where' => 'AND tt_content.pid=###CURRENT_PID### AND tt_content.CType="timeline"',
                'maxitems' => 1,
                'default' => 0,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:' . $generalLanguageFile . ':LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:hidden.I.0'
                    ]
                ]
            ]
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:' . $generalLanguageFile . ':LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => 0
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly'
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:' . $generalLanguageFile . ':LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ]
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly'
        ],
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:' . $generalLanguageFile . ':LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    [
                        'LLL:' . $generalLanguageFile . ':LGL.allLanguages',
                        -1
                    ],
                    [
                        'LLL:' . $generalLanguageFile . ':LGL.default_value',
                        0
                    ]
                ],
                'allowNonIdValues' => true,
            ]
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:' . $generalLanguageFile . ':LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        '',
                        0
                    ]
                ],
                'foreign_table' => 'tx_bootstrappackage_timeline_item',
                'foreign_table_where' => 'AND tx_bootstrappackage_timeline_item.pid=###CURRENT_PID### AND tx_bootstrappackage_timeline_item.sys_language_uid IN (-1,0)',
                'default' => 0
            ]
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough'
            ]
        ],
        'date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:timeline_item.date',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'dbType' => 'date',
                'eval' => 'date,required',
                'default' => '0000-00-00'
            ],
            'l10n_mode' => 'exclude',
        ],
        'header' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:timeline_item.header',
            'config' => [
                'type' => 'input',
                'size' => 50,
                'eval' => 'trim,required'
            ],
        ],
        'bodytext' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:timeline_item.bodytext',
            'l10n_mode' => 'prefixLangTitle',
            'l10n_cat' => 'text',
            'config' => [
                'type' => 'text',
                'cols' => '80',
                'rows' => '15',
                'softref' => 'typolink_tag,images,email[subst],url',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default'
            ],
        ],
        'icon_file' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:timeline_item.icon_file',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'icon_file',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    'overrideChildTca' => [
                        'types' => [
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_UNKNOWN => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                        ],
                    ],
                    'minitems' => 0,
                    'maxitems' => 1,
                ],
                'svg'
            ),
            'l10n_mode' => 'exclude',
        ],
        'image' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:timeline_item.image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'image',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    'overrideChildTca' => [
                        'types' => [
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_UNKNOWN => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                                    title,
                                    alternative,
                                    crop,
                                    --palette--;;filePalette
                                '
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                        ],
                    ],
                    'minitems' => 0,
                    'maxitems' => 1,
                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ],
    ],
];
