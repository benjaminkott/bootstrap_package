<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

// Add Content Element
if (!is_array($GLOBALS['TCA']['tt_content']['types']['texticon'] ?? false)) {
    $GLOBALS['TCA']['tt_content']['types']['texticon'] = [];
}

// Add content element PageTSConfig
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    'bootstrap_package',
    'Configuration/TsConfig/Page/ContentElement/Element/Texticon.tsconfig',
    'Bootstrap Package Content Element: Text and Icon'
);

// Add content element to selector list
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.texticon',
        'description' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.texticon.description',
        'value' =>'texticon',
        'icon' => 'content-bootstrappackage-texticon',
        'group' => 'bootstrap_package',
    ],
    'textcolumn',
    'after'
);

// Assign Icon
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['texticon'] = 'content-bootstrappackage-texticon';

// Register palettes
$GLOBALS['TCA']['tt_content']['palettes']['bootstrap_package_icons'] = [
    'showitem' => '
        icon_position, icon_type, icon_size, --linebreak--,
        icon_color, icon_background, --linebreak--,
        icon_set, --linebreak--,
        icon, icon_file
    ',
];

// Configure element type
$GLOBALS['TCA']['tt_content']['types']['texticon'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['texticon'],
    [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
                bodytext,
            --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tabs.icon,
                --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon;bootstrap_package_icons,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        ',
        'columnsOverrides' => [
            'bodytext' => [
                'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel',
                'config' => [
                    'enableRichtext' => true,
                ],
            ],
        ],
    ]
);

// Register fields
$GLOBALS['TCA']['tt_content']['columns'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['columns'],
    [
        'icon_set' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_set',
            'onChange' => 'reload',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'itemsProcFunc' => 'BK2K\BootstrapPackage\Service\IconService->getIconSetItems',
            ],
            'l10n_mode' => 'exclude',
        ],
        'icon' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon',
            'displayCond' => 'FIELD:icon_set:REQ:true',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'itemsProcFunc' => 'BK2K\BootstrapPackage\Service\IconService->getIconItems',
                'fieldWizard' => [
                    'selectIcons' => [
                        'renderType' => 'iconWizard',
                        'disabled' => false,
                    ],
                ],
            ],
            'l10n_mode' => 'exclude',
        ],
        'icon_file' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_file',
            'displayCond' => 'FIELD:icon_set:REQ:false',
            'config' => [
                'type' => 'file',
                'allowed' => ['gif', 'png', 'svg'],
                'appearance' => [
                    'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/Database.xlf:tt_content.asset_references.addFileReference',
                ],
                'overrideChildTca' => [
                    'types' => [
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                            'showitem' => '--palette--;;filePalette',
                        ],
                    ],
                ],
                'minitems' => 0,
                'maxitems' => 1,
            ],
            'l10n_mode' => 'exclude',
        ],
        'icon_position' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_position',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.left',
                        'value' => 'left',
                    ],
                    [
                        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.right',
                        'value' => 'right',
                    ],
                    [
                        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.top',
                        'value' => 'top',
                    ],
                ],
            ],
        ],
        'icon_type' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_type',
            'onChange' => 'reload',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 'default',
                'items' => [
                    [
                        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.default',
                        'value' => 'default',
                    ],
                    [
                        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.square',
                        'value' => 'square',
                    ],
                    [
                        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.circle',
                        'value' => 'circle',
                    ],
                ],
            ],
        ],
        'icon_size' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_size',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.default',
                        'value' => 'default',
                    ],
                    [
                        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.medium',
                        'value' => 'medium',
                    ],
                    [
                        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.large',
                        'value' => 'large',
                    ],
                    [
                        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.awesome',
                        'value' => 'awesome',
                    ],
                ],
            ],
        ],
        'icon_color' => [
            'displayCond' => 'FIELD:icon_type:!=:default',
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_color',
            'config' => [
                'type' => 'color',
                'default' => '#FFFFFF',
            ],
        ],
        'icon_background' => [
            'displayCond' => 'FIELD:icon_type:!=:default',
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_background',
            'config' => [
                'type' => 'color',
                'default' => '#333333',
            ],
        ],
    ]
);
