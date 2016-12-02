<?php
defined('TYPO3_MODE') || die();

/***************
 * Add Content Element: Text Teaser
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['textteaser'] = 'content-bootstrappackage-textteaser';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.textteaser',
        'textteaser',
        'content-bootstrappackage-textteaser'
    ],
    'text',
    'after'
);
if (!is_array($GLOBALS['TCA']['tt_content']['types']['textteaser'])) {
    $GLOBALS['TCA']['tt_content']['types']['textteaser'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['textteaser'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['textteaser'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
            teaser,
            bodytext,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            rowDescription',
        'columnsOverrides' => [
            'bodytext' => [
                'defaultExtras' => 'richtext:rte_transform[mode=ts_css]'
            ]

        ]
    ]
);
