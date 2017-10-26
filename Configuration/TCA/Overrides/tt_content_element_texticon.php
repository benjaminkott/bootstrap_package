<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') || die();

/***************
 * Add Content Element
 */
if (!is_array($GLOBALS['TCA']['tt_content']['types']['texticon'])) {
    $GLOBALS['TCA']['tt_content']['types']['texticon'] = [];
}

/***************
 * Add content element to selector list
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.texticon',
        'texticon',
        'content-bootstrappackage-texticon'
    ],
    'tab',
    'after'
);

/***************
 * Assign Icon
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['texticon'] = 'content-bootstrappackage-texticon';

/***************
 * Register palettes
 */
$GLOBALS['TCA']['tt_content']['palettes']['bootstrap_package_icons'] = [
    'showitem' => '
        icon_position, icon_type, icon_size, --linebreak--,
        icon_color, icon_background, --linebreak--,
        icon
    '
];

/***************
 * Configure element type
 */
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
                    'richtextConfiguration' => 'default'
                ]
            ]
        ]
    ]
);

/***************
 * Register fields
 */
$GLOBALS['TCA']['tt_content']['columns'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['columns'],
    [
        'icon' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.none', 0, 'EXT:bootstrap_package/Resources/Public/Images/Icons/none.jpg'],
                ],
                'itemsProcFunc' => 'BK2K\BootstrapPackage\Utility\TextIconUtility->addIconItems',
                'fieldWizard' => [
                    'selectIcons' => [
                        'disabled' => false,
                    ],
                ],
            ],
        ],
        'icon_position' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_position',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.left', 'left'],
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.right', 'right'],
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.top', 'top'],
                ],
            ],
        ],
        'icon_type' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_type',
            'onChange' => 'reload',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => '0',
                'items' => [
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.default', 0],
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.square', 1],
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.circle', 2],
                ],
            ],
        ],
        'icon_size' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_size',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.default', 0],
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.medium', 1],
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.large', 2],
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.awesome', 3],
                ],
            ],
        ],
        'icon_color' => [
            'displayCond' => 'FIELD:icon_type:!=:0',
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_color',
            'config' => [
                'type' => 'input',
                'renderType' => 'colorpicker',
                'default' => '#FFFFFF',
            ],
        ],
        'icon_background' => [
            'displayCond' => 'FIELD:icon_type:!=:0',
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_background',
            'config' => [
                'type' => 'input',
                'renderType' => 'colorpicker',
                'default' => '#333333',
            ],
        ],
    ]
);
