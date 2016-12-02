<?php
defined('TYPO3_MODE') || die();

/***************
 * Add Content Element: Shortcut
 */
if (!is_array($GLOBALS['TCA']['tt_content']['types']['shortcut'])) {
    $GLOBALS['TCA']['tt_content']['types']['shortcut'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['shortcut'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['shortcut'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header.ALT.shortcut_formlabel,
            records;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:records_formlabel,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            hidden;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:field.default.hidden,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            rowDescription'
    ]
);
