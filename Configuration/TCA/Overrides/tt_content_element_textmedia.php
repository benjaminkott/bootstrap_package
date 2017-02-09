<?php
defined('TYPO3_MODE') || die();

/***************
 * Add Content Element: Textmedia
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['textmedia'] = 'content-bootstrappackage-textmedia';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.textmedia',
        'textmedia',
        'content-bootstrappackage-textmedia'
    ],
    'text',
    'after'
);
if (!is_array($GLOBALS['TCA']['tt_content']['types']['textmedia'])) {
    $GLOBALS['TCA']['tt_content']['types']['textmedia'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['textmedia'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['textmedia'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
            bodytext,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.media,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:palette.alignment;mediablock,
            assets,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.imagelinks;imagelinks,
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
