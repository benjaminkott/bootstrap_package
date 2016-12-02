<?php
defined('TYPO3_MODE') || die();

/***************
 * Add Content Element: Text
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['text'] = 'content-text';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:CType.I.1',
        'text',
        'content-text'
    ],
    'header',
    'after'
);
if (!is_array($GLOBALS['TCA']['tt_content']['types']['text'])) {
    $GLOBALS['TCA']['tt_content']['types']['text'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['text'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['text'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
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
