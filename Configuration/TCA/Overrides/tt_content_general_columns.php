<?php
defined('TYPO3_MODE') || die();

/***************
 * Adjust columns for generic usage
 */
$GLOBALS['TCA']['tt_content']['columns']['header_position'] = [
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.header_position',
    'exclude' => true,
    'config' => [
        'type' => 'select',
        'renderType' => 'selectSingle',
        'items' => [
            ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.header_position.default', ''],
            ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.header_position.center', 'center'],
            ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.header_position.right', 'right'],
            ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.header_position.left', 'left']
        ],
        'default' => ''
    ]
];
$GLOBALS['TCA']['tt_content']['columns']['teaser'] = [
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.teaser',
    'exclude' => true,
    'config' => [
        'type' => 'text',
        'softref' => 'rtehtmlarea_images,typolink_tag',
        'cols' => '40',
        'rows' => '3'
    ]
];
$GLOBALS['TCA']['tt_content']['columns']['section_frame'] = [
    'exclude' => true,
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.section_frame',
    'config' => [
        'type' => 'select',
        'renderType' => 'selectSingle',
        'items' => [
            ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.section_frame.default', '0'],
            ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.section_frame.invisible', '1'],
            ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.section_frame.rulerbefore', '5'],
            ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.section_frame.rulerafter', '6'],
            ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.section_frame.indentcenter', '10'],
            ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.section_frame.indentleft', '11'],
            ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.section_frame.indentright', '12'],
            ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.section_frame.well', '20'],
            ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.section_frame.jumbotron', '21'],
            ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.section_frame.none', '66']
        ],
        'default' => '0'
    ]
];
$GLOBALS['TCA']['tt_content']['columns']['imageorient']['config']['items'] = [
    ['LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.0', 0, 'content-beside-text-img-above-center'],
    ['LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.3', 8, 'content-beside-text-img-below-center'],
    ['LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.9', 25, 'content-beside-text-img-right'],
    ['LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:imageorient.I.10', 26, 'content-beside-text-img-left']
];
$GLOBALS['TCA']['tt_content']['columns']['assets'] = [
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.assets',
    'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
        'assets',
        [
            'foreign_types' => $GLOBALS['TCA']['tt_content']['columns']['image']['config']['foreign_types']
        ],
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext']
    )
];
