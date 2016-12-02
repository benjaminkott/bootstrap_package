<?php
defined('TYPO3_MODE') || die();

/***************
 * Add Content Element: Bootstrap Package Panel
 */
if (!is_array($GLOBALS['TCA']['tt_content']['types']['bootstrap_package_listgroup'])) {
    $GLOBALS['TCA']['tt_content']['types']['bootstrap_package_listgroup'] = [];
}

/***************
 * Add content element to seletor list
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.listgroup',
        'bootstrap_package_listgroup',
        'content-bootstrappackage-listgroup'
    ],
    'bootstrap_package_external_media',
    'after'
);

/***************
 * Assign Icon
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['bootstrap_package_listgroup'] = 'content-bootstrappackage-listgroup';

/***************
 * Configure element type
 */
$GLOBALS['TCA']['tt_content']['types']['bootstrap_package_listgroup'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['bootstrap_package_listgroup'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;bootstrap_package_headersimple,
            bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
            rte_enabled;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:rte_enabled_formlabel,
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
            ],
        ],
    ]
);
