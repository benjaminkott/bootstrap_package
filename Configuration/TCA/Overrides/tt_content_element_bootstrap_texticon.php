<?php
defined('TYPO3_MODE') || die();

/***************
 * Add Content Element: Bootstrap Package Texticon
 */
if (!is_array($GLOBALS['TCA']['tt_content']['types']['bootstrap_package_texticon'])) {
    $GLOBALS['TCA']['tt_content']['types']['bootstrap_package_texticon'] = [];
}

/***************
 * Add content element to seletor list
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.texticon',
        'bootstrap_package_texticon',
        'content-bootstrappackage-texticon'
    ],
    'bootstrap_package_tab',
    'after'
);

/***************
 * Assign Icon
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['bootstrap_package_texticon'] = 'content-bootstrappackage-texticon';

/***************
 * Register palettes
 */
$GLOBALS['TCA']['tt_content']['palettes']['bootstrap_package_icons'] = [
    'canNotCollapse' => 1,
    'showitem' => '
        icon_position, icon_type, icon_size, --linebreak--,
        icon_color, icon_background, --linebreak--,
        icon
    '
];

/***************
 * Register request update
 */
 $GLOBALS['TCA']['tt_content']['ctrl']['requestUpdate'] .= ',icon_type';

/***************
 * Configure element type
 */
$GLOBALS['TCA']['tt_content']['types']['bootstrap_package_texticon'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['bootstrap_package_texticon'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
            bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
            rte_enabled;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:rte_enabled_formlabel,
            --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tabs.icon,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon;bootstrap_package_icons,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
            categories
        ',
        'columnsOverrides' => [
            'bodytext' => [
                'defaultExtras' => 'richtext:rte_transform[mode=ts_css]'
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
                'showIconTable' => true,
                'selicon_cols' => 14,
                'items' => [
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.none', 0, 'EXT:bootstrap_package/Resources/Public/Images/Icons/none.jpg'],
                ],
                'itemsProcFunc' => 'BK2K\BootstrapPackage\Utility\TextIconUtility->addIconItems'
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
                'size' => 10,
                'eval' => 'trim',
                'default' => '#FFFFFF',
                'wizards' => [
                    'colorChoice' => [
                        'type' => 'colorbox',
                        'title' => 'LLL:EXT:lang/locallang_wizards:colorpicker_title',
                        'module' => [
                            'name' => 'wizard_colorpicker'
                        ],
                        'dim' => '20x20',
                        'JSopenParams' => 'height=600,width=380,status=0,menubar=0,scrollbars=1',
                    ],
                ],
            ],
        ],
        'icon_background' => [
            'displayCond' => 'FIELD:icon_type:!=:0',
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_background',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim',
                'default' => '#333333',
                'wizards' => [
                    'colorChoice' => [
                        'type' => 'colorbox',
                        'title' => 'LLL:EXT:lang/locallang_wizards:colorpicker_title',
                        'module' => [
                            'name' => 'wizard_colorpicker'
                        ],
                        'dim' => '20x20',
                        'JSopenParams' => 'height=600,width=380,status=0,menubar=0,scrollbars=1',
                    ],
                ],
            ],
        ],
    ]
);
