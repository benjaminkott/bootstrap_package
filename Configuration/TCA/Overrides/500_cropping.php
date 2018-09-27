<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') || die();

/***************
 * Add crop variants
 */
$defaultCropSettings = [
    'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.default',
    'allowedAspectRatios' => [
        '16:9' => [
            'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:ratio.16_9',
            'value' => 16 / 9
        ],
        '4:3' => [
            'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:ratio.4_3',
            'value' => 4 / 3
        ],
        '1:1' => [
            'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:ratio.1_1',
            'value' => 1.0
        ],
        'NaN' => [
            'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:ratio.free',
            'value' => 0.0
        ],
    ],
    'selectedRatio' => 'NaN',
    'cropArea' => [
        'x' => 0.0,
        'y' => 0.0,
        'width' => 1.0,
        'height' => 1.0,
    ]
];
$largeCropSettings = $defaultCropSettings;
$largeCropSettings['title'] = 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.large';
$mediumCropSettings = $defaultCropSettings;
$mediumCropSettings['title'] = 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.medium';
$smallCropSettings = $defaultCropSettings;
$smallCropSettings['title'] = 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.small';
$extrasmallCropSettings = $defaultCropSettings;
$extrasmallCropSettings['title'] = 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.extrasmall';

/***************
 * Content Element Background Image
 */
$GLOBALS['TCA']['tt_content']['columns']['background_image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['default'] = $defaultCropSettings;
$GLOBALS['TCA']['tt_content']['columns']['background_image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['large'] = $largeCropSettings;
$GLOBALS['TCA']['tt_content']['columns']['background_image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['medium'] = $mediumCropSettings;
$GLOBALS['TCA']['tt_content']['columns']['background_image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['small'] = $smallCropSettings;
$GLOBALS['TCA']['tt_content']['columns']['background_image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['extrasmall'] = $extrasmallCropSettings;

/***************
 * Image content element
 */
$GLOBALS['TCA']['tt_content']['types']['image']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['default'] = $defaultCropSettings;
$GLOBALS['TCA']['tt_content']['types']['image']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['large'] = $largeCropSettings;
$GLOBALS['TCA']['tt_content']['types']['image']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['medium'] = $mediumCropSettings;
$GLOBALS['TCA']['tt_content']['types']['image']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['small'] = $smallCropSettings;
$GLOBALS['TCA']['tt_content']['types']['image']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['extrasmall'] = $extrasmallCropSettings;

/***************
 * Textpic content element
 */
$GLOBALS['TCA']['tt_content']['types']['textpic']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['default'] = $defaultCropSettings;
$GLOBALS['TCA']['tt_content']['types']['textpic']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['large'] = $largeCropSettings;
$GLOBALS['TCA']['tt_content']['types']['textpic']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['medium'] = $mediumCropSettings;
$GLOBALS['TCA']['tt_content']['types']['textpic']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['small'] = $smallCropSettings;
$GLOBALS['TCA']['tt_content']['types']['textpic']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['extrasmall'] = $extrasmallCropSettings;

/***************
 * Media content element
 */
$GLOBALS['TCA']['tt_content']['types']['media']['columnsOverrides']['assets']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['default'] = $defaultCropSettings;
$GLOBALS['TCA']['tt_content']['types']['media']['columnsOverrides']['assets']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['large'] = $largeCropSettings;
$GLOBALS['TCA']['tt_content']['types']['media']['columnsOverrides']['assets']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['medium'] = $mediumCropSettings;
$GLOBALS['TCA']['tt_content']['types']['media']['columnsOverrides']['assets']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['small'] = $smallCropSettings;
$GLOBALS['TCA']['tt_content']['types']['media']['columnsOverrides']['assets']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['extrasmall'] = $extrasmallCropSettings;

/***************
 * Textmedia content element
 */
$GLOBALS['TCA']['tt_content']['types']['textmedia']['columnsOverrides']['assets']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['default'] = $defaultCropSettings;
$GLOBALS['TCA']['tt_content']['types']['textmedia']['columnsOverrides']['assets']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['large'] = $largeCropSettings;
$GLOBALS['TCA']['tt_content']['types']['textmedia']['columnsOverrides']['assets']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['medium'] = $mediumCropSettings;
$GLOBALS['TCA']['tt_content']['types']['textmedia']['columnsOverrides']['assets']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['small'] = $smallCropSettings;
$GLOBALS['TCA']['tt_content']['types']['textmedia']['columnsOverrides']['assets']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['extrasmall'] = $extrasmallCropSettings;

/***************
 * Card Group
 */
$GLOBALS['TCA']['tx_bootstrappackage_card_group_item']['types']['1']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['default'] = $defaultCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_card_group_item']['types']['1']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['large'] = $largeCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_card_group_item']['types']['1']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['medium'] = $mediumCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_card_group_item']['types']['1']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['small'] = $smallCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_card_group_item']['types']['1']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['extrasmall'] = $extrasmallCropSettings;

/***************
 * Accordion
 */
$GLOBALS['TCA']['tx_bootstrappackage_accordion_item']['types']['1']['columnsOverrides']['media']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['default'] = $defaultCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_accordion_item']['types']['1']['columnsOverrides']['media']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['large'] = $largeCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_accordion_item']['types']['1']['columnsOverrides']['media']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['medium'] = $mediumCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_accordion_item']['types']['1']['columnsOverrides']['media']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['small'] = $smallCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_accordion_item']['types']['1']['columnsOverrides']['media']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['extrasmall'] = $extrasmallCropSettings;

/***************
 * Carousel Background Image
 */
$GLOBALS['TCA']['tx_bootstrappackage_carousel_item']['columns']['background_image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['default'] = $defaultCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_carousel_item']['columns']['background_image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['large'] = $largeCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_carousel_item']['columns']['background_image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['medium'] = $mediumCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_carousel_item']['columns']['background_image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['small'] = $smallCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_carousel_item']['columns']['background_image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['extrasmall'] = $extrasmallCropSettings;

/***************
 * Tab
 */
$GLOBALS['TCA']['tx_bootstrappackage_tab_item']['types']['1']['columnsOverrides']['media']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['default'] = $defaultCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_tab_item']['types']['1']['columnsOverrides']['media']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['large'] = $largeCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_tab_item']['types']['1']['columnsOverrides']['media']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['medium'] = $mediumCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_tab_item']['types']['1']['columnsOverrides']['media']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['small'] = $smallCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_tab_item']['types']['1']['columnsOverrides']['media']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['extrasmall'] = $extrasmallCropSettings;

/***************
 * Timeline
 */
$GLOBALS['TCA']['tx_bootstrappackage_timeline_item']['types']['1']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['default'] = $defaultCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_timeline_item']['types']['1']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['large'] = $largeCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_timeline_item']['types']['1']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['medium'] = $mediumCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_timeline_item']['types']['1']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['small'] = $smallCropSettings;
$GLOBALS['TCA']['tx_bootstrappackage_timeline_item']['types']['1']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['extrasmall'] = $extrasmallCropSettings;

/***************
 * Pages
 */
foreach ([1, 3, 4] as $type) {
    $GLOBALS['TCA']['pages']['types'][$type]['columnsOverrides']['thumbnail']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['default'] = $defaultCropSettings;
    $GLOBALS['TCA']['pages']['types'][$type]['columnsOverrides']['thumbnail']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['large'] = $largeCropSettings;
    $GLOBALS['TCA']['pages']['types'][$type]['columnsOverrides']['thumbnail']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['medium'] = $mediumCropSettings;
    $GLOBALS['TCA']['pages']['types'][$type]['columnsOverrides']['thumbnail']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['small'] = $smallCropSettings;
    $GLOBALS['TCA']['pages']['types'][$type]['columnsOverrides']['thumbnail']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['extrasmall'] = $extrasmallCropSettings;
}
