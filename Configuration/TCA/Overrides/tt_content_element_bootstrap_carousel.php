<?php
defined('TYPO3_MODE') || die();

/***************
 * Add Content Element: Bootstrap Package Tab
 */
if (!is_array($GLOBALS['TCA']['tt_content']['types']['bootstrap_package_carousel'])) {
    $GLOBALS['TCA']['tt_content']['types']['bootstrap_package_carousel'] = [];
}

/***************
 * Add content element to seletor list
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.carousel',
        'bootstrap_package_carousel',
        'content-bootstrappackage-carousel'
    ],
    'bootstrap_package_accordion',
    'after'
);

/***************
 * Assign Icon
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['bootstrap_package_carousel'] = 'content-bootstrappackage-carousel';

/***************
 * Configure element type
 */
$GLOBALS['TCA']['tt_content']['types']['bootstrap_package_carousel'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['bootstrap_package_carousel'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;bootstrap_package_header,
            tx_bootstrappackage_carousel_item,
            --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel.options,
            pi_flexform;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:advanced,
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
        'tx_bootstrappackage_carousel_item' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_bootstrappackage_carousel_item',
                'foreign_field' => 'tt_content',
                'appearance' => [
                    'useSortable' => true,
                    'showSynchronizationLink' => true,
                    'showAllLocalizationLink' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showRemovedLocalizationRecords' => false,
                    'expandSingle' => true,
                    'enabledControls' => [
                        'localize' => true,
                    ]
                ],
                'behaviour' => [
                    'localizationMode' => 'select',
                    'mode' => 'select',
                    'localizeChildrenAtParentLocalization' => true,
                ]
            ]
        ]
    ]
);

/***************
 * Add flexForms for content element configuration
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:bootstrap_package/Configuration/FlexForms/Carousel.xml',
    'bootstrap_package_carousel'
);
