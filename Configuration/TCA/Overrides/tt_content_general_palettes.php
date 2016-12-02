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
$GLOBALS['TCA']['tt_content']['palettes']['header'] = [
    'showitem' => '
        header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,
        --linebreak--,
        subheader;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:subheader_formlabel,
        --linebreak--,
        header_layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout_formlabel,
        header_position;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_position_formlabel,
        --linebreak--,
        header_link;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel,
        --linebreak--
    '
];
$GLOBALS['TCA']['tt_content']['palettes']['frames'] = [
    'showitem' => '
        layout,
        section_frame
    ',
];
$GLOBALS['TCA']['tt_content']['palettes']['tablelayout'] = [
    'showitem' => '
        table_header_position,
        table_tfoot
    ',
];
$GLOBALS['TCA']['tt_content']['palettes']['bootstrap_package_header'] = [
    'canNotCollapse' => 1,
    'showitem' => '
        header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,
        --linebreak--,
        subheader;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:subheader_formlabel,
        --linebreak--,
        header_layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout_formlabel,
        --linebreak--,
        header_link;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel
    '
];
$GLOBALS['TCA']['tt_content']['palettes']['bootstrap_package_headersimple'] = [
    'canNotCollapse' => 1,
    'showitem' => '
        header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,
        --linebreak--,
        header_layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout_formlabel
    '
];
$GLOBALS['TCA']['tt_content']['palettes']['bootstrap_package_external_media'] = [
    'canNotCollapse' => 1,
    'showitem' => '
        external_media_source, --linebreak--,
        external_media_ratio
    '
];
