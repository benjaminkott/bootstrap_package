<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

// Adjust columns for generic usage
$GLOBALS['TCA']['tt_content']['columns']['frame_layout'] = [
    'exclude' => true,
    'displayCond' => 'FIELD:frame_class:!=:none',
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.frame_layout',
    'config' => [
        'type' => 'select',
        'renderType' => 'selectSingle',
        'items' => [
            ['default', 'default'],
            ['embedded', 'embedded']
        ]
    ],
    'l10n_mode' => 'exclude',
];
$GLOBALS['TCA']['tt_content']['columns']['background_color_class'] = [
    'exclude' => true,
    'displayCond' => 'FIELD:frame_class:!=:none',
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.background_color_class',
    'config' => [
        'type' => 'select',
        'renderType' => 'selectSingle',
        'items' => [
            ['none', 'none'],
            ['primary', 'primary'],
            ['secondary', 'secondary'],
            ['tertiary', 'tertiary'],
            ['quaternary', 'quaternary'],
            ['light', 'light'],
            ['dark', 'dark']
        ]
    ],
    'l10n_mode' => 'exclude',
];
$GLOBALS['TCA']['tt_content']['columns']['background_image'] = [
    'exclude' => true,
    'displayCond' => 'FIELD:frame_class:!=:none',
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.background_image',
    'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
        'background_image',
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
    'l10n_mode' => 'exclude',
];
$GLOBALS['TCA']['tt_content']['columns']['background_image_options'] = [
    'exclude' => true,
    'displayCond' => 'FIELD:frame_class:!=:none',
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.background_image_options',
    'config' => [
        'type' => 'flex',
        'ds' => [
            'default' => 'FILE:EXT:bootstrap_package/Configuration/FlexForms/BackgroundImage.xml',
        ],
    ],
    'l10n_mode' => 'exclude',
];
$GLOBALS['TCA']['tt_content']['columns']['readmore_label'] = [
    'exclude' => true,
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.readmore_label',
    'config' => [
        'type' => 'input',
        'eval' => 'trim',
        'size' => 50,
        'max' => 255
    ]
];
$GLOBALS['TCA']['tt_content']['columns']['teaser'] = [
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.teaser',
    'exclude' => true,
    'config' => [
        'type' => 'text',
        'softref' => 'typolink_tag',
        'cols' => '40',
        'rows' => '3'
    ]
];
$GLOBALS['TCA']['tt_content']['columns']['tx_bootstrappackage_carousel_item'] = [
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item',
    'config' => [
        'type' => 'inline',
        'foreign_table' => 'tx_bootstrappackage_carousel_item',
        'foreign_field' => 'tt_content',
        'appearance' => [
            'useSortable' => true,
            'showSynchronizationLink' => true,
            'showAllLocalizationLink' => true,
            'showPossibleLocalizationRecords' => true,
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
$GLOBALS['TCA']['tt_content']['columns']['file_folder'] = [
    'exclude' => true,
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.file_folder',
    'config' => [
        'type' => 'group',
        'internal_type' => 'folder',
    ]
];
$GLOBALS['TCA']['tt_content']['columns']['aspect_ratio'] = [
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.aspect_ratio',
    'config' => [
        'type' => 'select',
        'renderType' => 'selectSingle',
        'items' => [
            ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:ratio.4_3', (string) (4/3)],
            ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:ratio.16_9', (string) (16/9)],
            ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:ratio.1_1', (string) (1/1)],
        ]
    ],
    'l10n_mode' => 'exclude',
];
$GLOBALS['TCA']['tt_content']['columns']['items_per_page'] = [
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.items_per_page',
    'config' => [
        'type' => 'input',
        'size' => 2,
        'eval' => 'trim,int',
        'range' => [
            'lower' => 1,
            'upper' => 50,
        ],
        'default' => 10,
    ],
    'l10n_mode' => 'exclude',
];

// Adjust default fields
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'imageorient',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.imageorient.125',
        (string) 125,
        'content-bootstrappackage-beside-text-img-centered-right'
    ],
    (string) 125,
    'after'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'imageorient',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.imageorient.126',
        (string) 126,
        'content-bootstrappackage-beside-text-img-centered-left'
    ],
    (string) 126,
    'after'
);
$GLOBALS['TCA']['tt_content']['columns']['frame_class']['onChange'] = 'reload';

// Add fields to default palettes
$GLOBALS['TCA']['tt_content']['palettes']['frames']['showitem'] .= '
    --linebreak--,
    frame_layout,
    --linebreak--,
    background_color_class,
    --linebreak--,
    background_image,
    background_image_options,
';
