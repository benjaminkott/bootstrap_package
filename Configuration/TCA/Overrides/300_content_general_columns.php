<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

// Adjust columns for generic usage
$GLOBALS['TCA']['tt_content']['columns']['header_class'] = [
    'exclude' => true,
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.header_class',
    'config' => [
        'type' => 'select',
        'renderType' => 'selectSingle',
        'items' => [
            [
                'label' => '',
                'value' => '',
            ],
            [
                'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.h1',
                'value' => 'h1',
            ],
            [
                'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.h2',
                'value' => 'h2',
            ],
            [
                'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.h3',
                'value' => 'h3',
            ],
            [
                'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.h4',
                'value' => 'h4',
            ],
            [
                'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.h5',
                'value' => 'h5',
            ],
        ],
    ],
    'l10n_mode' => 'exclude',
];
$GLOBALS['TCA']['tt_content']['columns']['subheader_class'] = [
    'exclude' => true,
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.subheader_class',
    'config' => [
        'type' => 'select',
        'renderType' => 'selectSingle',
        'items' => [
            [
                'label' => '',
                'value' => '',
            ],
            [
                'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.h1',
                'value' => 'h1',
            ],
            [
                'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.h2',
                'value' => 'h2',
            ],
            [
                'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.h3',
                'value' => 'h3',
            ],
            [
                'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.h4',
                'value' => 'h4',
            ],
            [
                'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.h5',
                'value' => 'h5',
            ],
        ],
    ],
    'l10n_mode' => 'exclude',
];
$GLOBALS['TCA']['tt_content']['columns']['frame_layout'] = [
    'exclude' => true,
    'displayCond' => 'FIELD:frame_class:!=:none',
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.frame_layout',
    'config' => [
        'type' => 'select',
        'renderType' => 'selectSingle',
        'items' => [
            [
                'label' => 'default',
                'value' => 'default',
            ],
            [
                'label' => 'embedded',
                'value' => 'embedded',
            ],
        ],
    ],
    'l10n_mode' => 'exclude',
];
$GLOBALS['TCA']['tt_content']['columns']['frame_options'] = [
    'exclude' => true,
    'displayCond' => 'FIELD:frame_class:!=:none',
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.frame_options',
    'config' => [
        'type' => 'select',
        'renderType' => 'selectCheckBox',
        'items' => [
            [
                'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.frame_options.ruler_before',
                'value' => 'ruler-before',
            ],
            [
                'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.frame_options.ruler_after',
                'value' => 'ruler-after',
            ],
            [
                'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.frame_options.indent_left',
                'value' => 'indent-left',
            ],
            [
                'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.frame_options.indent_right',
                'value' => 'indent-right',
            ],
        ],
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
            [
                'label' => 'none',
                'value' => 'none',
            ],
            [
                'label' => 'primary',
                'value' => 'primary',
            ],
            [
                'label' => 'secondary',
                'value' => 'secondary',
            ],
            [
                'label' => 'tertiary',
                'value' => 'tertiary',
            ],
            [
                'label' => 'quaternary',
                'value' => 'quaternary',
            ],
            [
                'label' => 'light',
                'value' => 'light',
            ],
            [
                'label' => 'dark',
                'value' => 'dark',
            ],
        ],
    ],
    'l10n_mode' => 'exclude',
];
$GLOBALS['TCA']['tt_content']['columns']['background_image'] = [
    'exclude' => true,
    'displayCond' => 'FIELD:frame_class:!=:none',
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.background_image',
    'config' => [
        'type' => 'file',
        'allowed' => 'common-image-types',
        'minitems' => 0,
        'maxitems' => 1,
        'appearance' => [
            'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
        ],
        'overrideChildTca' => [
            'types' => [
                \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                    'showitem' => 'crop,--palette--;;filePalette',
                ],
            ],
        ],
    ],
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
        'max' => 255,
    ],
];
$GLOBALS['TCA']['tt_content']['columns']['teaser'] = [
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.teaser',
    'exclude' => true,
    'config' => [
        'type' => 'text',
        'softref' => 'typolink_tag',
        'cols' => '40',
        'rows' => '3',
    ],
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
            ],
        ],
        'behaviour' => [
            'mode' => 'select',
        ],
    ],
];
$GLOBALS['TCA']['tt_content']['columns']['file_folder'] = [
    'exclude' => true,
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.file_folder',
    'config' => [
        'type' => 'folder',
    ],
];
$GLOBALS['TCA']['tt_content']['columns']['aspect_ratio'] = [
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.aspect_ratio',
    'config' => [
        'type' => 'select',
        'renderType' => 'selectSingle',
        'items' => [
            [
                'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:ratio.4_3',
                'value' => (string) (4/3)],
            [
                'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:ratio.16_9',
                'value' => (string) (16/9)],
            [
                'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:ratio.1_1',
                'value' => (string) (1/1),
            ],
        ],
    ],
    'l10n_mode' => 'exclude',
];
$GLOBALS['TCA']['tt_content']['columns']['items_per_page'] = [
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.items_per_page',
    'config' => [
        'type' => 'number',
        'size' => 2,
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
        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.imageorient.125',
        'value' => (string) 125,
        'icon' => 'content-bootstrappackage-beside-text-img-centered-right',
    ],
    (string) 125,
    'after'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'imageorient',
    [
        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.imageorient.126',
        'value' => (string) 126,
        'icon' => 'content-bootstrappackage-beside-text-img-centered-left',
    ],
    (string) 126,
    'after'
);
$GLOBALS['TCA']['tt_content']['columns']['frame_class']['onChange'] = 'reload';

// Selector for header layout of subitems
$GLOBALS['TCA']['tt_content']['columns']['subitems_header_layout'] = [
        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:subitems_header_layout',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'default' => 2,
            'items' => [
                [
                    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.h2',
                    'value' => 2,
                ],
                [
                    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.h3',
                    'value' => 3,
                ],
                [
                    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.h4',
                    'value' => 4,
                ],
                [
                    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.h5',
                    'value' => 5,
                ],
        ],
    ],
];

// Add fields to default palettes
$GLOBALS['TCA']['tt_content']['palettes']['frames']['showitem'] .= '
    --linebreak--,
    frame_layout,
    frame_options,
    --linebreak--,
    background_color_class,
    --linebreak--,
    background_image,
    background_image_options,
';
