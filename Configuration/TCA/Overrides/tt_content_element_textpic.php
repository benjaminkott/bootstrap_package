<?php
defined('TYPO3_MODE') || die();

/***************
 * Add Content Element: Textpic
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['textpic'] = 'content-textpic';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:CType.I.2',
        'textpic',
        'content-textpic'
    ],
    'text',
    'after'
);
if (!is_array($GLOBALS['TCA']['tt_content']['types']['textpic'])) {
    $GLOBALS['TCA']['tt_content']['types']['textpic'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['textpic'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['textpic'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
            bodytext,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.images,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:palette.alignment;imageblock,
            image,
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
