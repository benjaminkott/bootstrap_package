<?php
defined('TYPO3_MODE') || die();

/***************
 * Add Palettes for Generic usage
 */
$GLOBALS['TCA']['tt_content']['palettes']['imageblock'] = [
    'showitem' => '
        imageorient,
        imagecols
    '
];
$GLOBALS['TCA']['tt_content']['palettes']['mediablock'] = [
    'showitem' => '
        imageorient,
        imagecols
    '
];
$GLOBALS['TCA']['tt_content']['palettes']['header_minimal'] = [
    'showitem' => '
        header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,
        --linebreak--,
        header_layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout_formlabel,
    '
];
