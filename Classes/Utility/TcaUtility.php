<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Utility;

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * TcaUtility
 */
class TcaUtility
{
    public static function getLanguage(): array
    {
        return [
            'label' => 'EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    [
                        'EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1
                    ],
                    [
                        'EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.default_value',
                        0
                    ]
                ],
                'allowNonIdValues' => true,
            ]
        ];
    }

    public static function getLanguageParent(string $table): array
    {
        return [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        '',
                        0
                    ]
                ],
                'foreign_table' => $table,
                'foreign_table_where' => 'AND ' . $table . '.pid=###CURRENT_PID### AND ' . $table . '.sys_language_uid IN (-1,0)',
                'default' => 0
            ]
        ];
    }

    public static function getLanguageDiff(): array
    {
        return [
            'config' => [
                'type' => 'passthrough'
            ]
        ];
    }

    public static function getHidden(): array
    {
        return [
            'label' => 'EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:hidden.I.0'
                    ]
                ]
            ]
        ];
    }

    public static function getStartTime(): array
    {
        return [
            'label' => 'EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => 0
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly'
        ];
    }

    public static function getEndTime(): array
    {
        return [
            'label' => 'EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
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
        ];
    }

    public static function getText(string $label, string $eval = 'trim', int $size = 50, int $max = 255): array
    {
        return [
            'label' => $label,
            'config' => [
                'type' => 'input',
                'size' => $size,
                'max' => $max,
                'eval' => $eval
            ],
        ];
    }

    public static function getTextarea(string $label, string $eval = 'trim', int $cols = 40, int $rows = 3): array
    {
        return [
            'label' => $label,
            'config' => [
                'type' => 'text',
                'cols' => $cols,
                'rows' => $rows,
                'eval' => $eval
            ],
        ];
    }

    public static function getFolder(string $label): array
    {
        return [
            'label' => $label,
            'config' => [
                'type' => 'group',
                'internal_type' => 'folder',
            ],
            'l10n_mode' => 'exclude'
        ];
    }

    public static function getRTE(string $label): array
    {
        return [
            'label' => $label,
            'config' => [
                'type' => 'text',
                'cols' => '80',
                'rows' => '15',
                'softref' => 'typolink_tag,images,email[subst],url',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default'
            ]
        ];
    }

    public static function getLink(string $label): array
    {
        return [
            'label' => $label,
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
                'size' => 50,
                'max' => 1024,
                'eval' => 'trim',
                'fieldControl' => [
                    'linkPopup' => [
                        'options' => [
                            'title' => $label,
                        ],
                    ],
                ],
                'softref' => 'typolink'
            ],
            'l10n_mode' => 'exclude'
        ];
    }

    public static function getInlineRelation(string $label, string $foreignTable, string $foreignField): array
    {
        return [
            'label' => $label,
            'config' => [
                'type' => 'inline',
                'foreign_table' => $foreignTable,
                'foreign_field' => $foreignField,
                'appearance' => [
                    'useSortable' => true,
                    'showSynchronizationLink' => true,
                    'showAllLocalizationLink' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showRemovedLocalizationRecords' => false,
                    'expandSingle' => true,
                    'enabledControls' => [
                        'localize' => true,
                    ]
                ],
                'behaviour' => [
                    'mode' => 'select',
                ]
            ]
        ];
    }

    public static function getContentElementRelation(string $label, string $field, array $values): array
    {
        $where = 'AND tt_content.pid=###CURRENT_PID###';
        if (count($values) === 1) {
            $where .= ' AND tt_content.' . $field . '="' . $values[0] . '"';
        } elseif (count($values) > 1) {
            $where .= ' AND tt_content.' . $field . ' IN ("' . implode('","', $values) . '")';
        }

        return [
            'label' => $label,
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tt_content',
                'foreign_table_where' => $where,
                'maxitems' => 1,
                'default' => 0,
            ]
        ];
    }

    public static function getOptions(string $label, array $options, string $default): array
    {
        return [
            'label' => $label,
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => $options,
                'default' => $default,
            ],
            'l10n_mode' => 'exclude'
        ];
    }

    public static function getToggle(string $label): array
    {
        return [
            'label' => $label,
            'config' => [
                'type' => 'check',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                    ]
                ],
            ]
        ];
    }

    public static function getColor(string $label, string $default = '#FFFFFF'): array
    {
        return [
            'label' => $label,
            'config' => [
                'type' => 'input',
                'renderType' => 'colorpicker',
                'default' => $default,
            ],
            'l10n_mode' => 'exclude',
        ];
    }

    public static function getDateTime(string $label): array
    {
        return [
            'label' => $label,
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'dbType' => 'datetime',
                'eval' => 'datetime,required'
            ],
            'l10n_mode' => 'exclude',
        ];
    }

    public static function getFlexform(string $label, string $flexform): array
    {
        return [
            'label' => $label,
            'config' => [
                'type' => 'flex',
                'ds' => [
                    'default' => $flexform,
                ],
            ],
            'l10n_mode' => 'exclude',
        ];
    }

    public static function getImage(string $label, string $field): array
    {
        return [
            'label' => $label,
            'config' => ExtensionManagementUtility::getFileFieldTCAConfig(
                $field,
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    'overrideChildTca' => [
                        'types' => [
                            File::FILETYPE_UNKNOWN => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            File::FILETYPE_TEXT => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            File::FILETYPE_IMAGE => [
                                'showitem' => '
                                    title,
                                    alternative,
                                    crop,
                                    --palette--;;filePalette
                                '
                            ],
                            File::FILETYPE_AUDIO => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            File::FILETYPE_VIDEO => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            File::FILETYPE_APPLICATION => [
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
        ];
    }

    public static function getSimpleImage(string $label, string $field): array
    {
        return [
            'label' => $label,
            'config' => ExtensionManagementUtility::getFileFieldTCAConfig(
                $field,
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    'overrideChildTca' => [
                        'types' => [
                            File::FILETYPE_UNKNOWN => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            File::FILETYPE_TEXT => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            File::FILETYPE_IMAGE => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            File::FILETYPE_AUDIO => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            File::FILETYPE_VIDEO => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            File::FILETYPE_APPLICATION => [
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
        ];
    }

    public static function getMedia(string $label, string $field): array
    {
        return [
            'label' => $label,
            'config' => ExtensionManagementUtility::getFileFieldTCAConfig(
                $field,
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    'overrideChildTca' => [
                        'types' => [
                            File::FILETYPE_UNKNOWN => [
                                'showitem' => '
                                    --palette--;;imageoverlayPalette,
                                    --palette--;;filePalette'
                            ],
                            File::FILETYPE_TEXT => [
                                'showitem' => '
                                    --palette--;;imageoverlayPalette,
                                    --palette--;;filePalette'
                            ],
                            File::FILETYPE_IMAGE => [
                                'showitem' => '
                                    --palette--;;imageoverlayPalette,
                                    --palette--;;filePalette'
                            ],
                            File::FILETYPE_AUDIO => [
                                'showitem' => '
                                    --palette--;;audioOverlayPalette,
                                    --palette--;;filePalette'
                            ],
                            File::FILETYPE_VIDEO => [
                                'showitem' => '
                                    --palette--;;videoOverlayPalette,
                                    --palette--;;filePalette'
                            ],
                            File::FILETYPE_APPLICATION => [
                                'showitem' => '
                                    --palette--;;imageoverlayPalette,
                                    --palette--;;filePalette'
                            ]
                        ]
                    ]
                ],
                $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext']
            ),
        ];
    }

    public static function getIcon(string $label, string $field): array
    {
        return [
            'label' => $label,
            'config' => ExtensionManagementUtility::getFileFieldTCAConfig(
                $field,
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    'overrideChildTca' => [
                        'types' => [
                            File::FILETYPE_UNKNOWN => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            File::FILETYPE_TEXT => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            File::FILETYPE_IMAGE => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            File::FILETYPE_AUDIO => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            File::FILETYPE_VIDEO => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                            File::FILETYPE_APPLICATION => [
                                'showitem' => '
                                    --palette--;;filePalette
                                '
                            ],
                        ],
                    ],
                    'minitems' => 1,
                    'maxitems' => 1,
                ],
                'gif,png,svg'
            ),
            'l10n_mode' => 'exclude',
        ];
    }
}
