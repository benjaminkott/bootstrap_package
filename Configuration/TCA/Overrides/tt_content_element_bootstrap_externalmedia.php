<?php
defined('TYPO3_MODE') || die();

/***************
 * Add Content Element: Bootstrap Package Panel
 */
if (!is_array($GLOBALS['TCA']['tt_content']['types']['bootstrap_package_external_media'])) {
    $GLOBALS['TCA']['tt_content']['types']['bootstrap_package_external_media'] = [];
}

/***************
 * Add content element to seletor list
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.external_media',
        'bootstrap_package_external_media',
        'content-bootstrappackage-externalmedia'
    ],
    'bootstrap_package_carousel',
    'after'
);

/***************
 * Assign Icon
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['bootstrap_package_external_media'] = 'content-bootstrappackage-externalmedia';

/***************
 * Configure element type
 */
$GLOBALS['TCA']['tt_content']['types']['bootstrap_package_external_media'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['bootstrap_package_external_media'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.palette.external_media;bootstrap_package_external_media,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
            categories
        '
    ]
);

/***************
 * Register fields
 */
$GLOBALS['TCA']['tt_content']['columns'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['columns'],
    [
        'external_media_source' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.external_media_source',
            'config' => [
                'type' => 'input',
                'size' => 50,
                'eval' => 'trim',
                'max' => 1024,
            ]
        ],
        'external_media_ratio' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.external_media_ratio',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['16:9', '16by9'],
                    ['4:3', '4by3'],
                ]
            ]
        ]
    ]
);
