<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use BK2K\BootstrapPackage\Utility\TcaUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3_MODE') || die();

// Background Color
$GLOBALS['TCA']['tt_content']['columns']['background_color_class'] =
    TcaUtility::getOptions(
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.background_color_class',
        [
            ['none', 'none'],
            ['primary', 'primary'],
            ['secondary', 'secondary'],
            ['light', 'light'],
            ['dark', 'dark']
        ],
        'none'
    );
$GLOBALS['TCA']['tt_content']['columns']['background_color_class']['displayCond'] = 'FIELD:frame_class:!=:none';

// Background Image
$GLOBALS['TCA']['tt_content']['columns']['background_image'] =
    TcaUtility::getSimpleImage(
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.background_image',
        'background_image'
    );
$GLOBALS['TCA']['tt_content']['columns']['background_image']['displayCond'] = 'FIELD:frame_class:!=:none';

// Background Image Options
$GLOBALS['TCA']['tt_content']['columns']['background_image_options'] =
    TcaUtility::getFlexform(
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.background_image_options',
        'FILE:EXT:bootstrap_package/Configuration/FlexForms/BackgroundImage.xml'
    );
$GLOBALS['TCA']['tt_content']['columns']['background_image']['displayCond'] = 'FIELD:frame_class:!=:none';

// Readmore Label
$GLOBALS['TCA']['tt_content']['columns']['readmore_label'] =
    TcaUtility::getText(
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.readmore_label'
    );
// Teaser
$GLOBALS['TCA']['tt_content']['columns']['teaser'] =
    TcaUtility::getTextarea(
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.teaser'
    );
// Carousel Item
$GLOBALS['TCA']['tt_content']['columns']['tx_bootstrappackage_carousel_item'] =
    TcaUtility::getInlineRelation(
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item',
        'tx_bootstrappackage_carousel_item',
        'tt_content'
    );
// File Folder
$GLOBALS['TCA']['tt_content']['columns']['file_folder'] =
    TcaUtility::getFolder(
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.file_folder'
    );

/***************
 * Adjust default fields
 */
ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'imageorient',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.imageorient.125',
        (string) 125,
        'content-bootstrappackage-beside-text-img-centered-right'
    ],
    (string) 125,
    'after'
);
ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'imageorient',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.imageorient.126',
        (string) 126,
        'content-bootstrappackage-beside-text-img-centered-left'
    ],
    (string) 126,
    'after'
);
$GLOBALS['TCA']['tt_content']['columns']['frame_class']['onChange'] = 'reload';

/***************
 * Add fields to default palettes
 */
$GLOBALS['TCA']['tt_content']['palettes']['frames']['showitem'] .= '
    --linebreak--,
    background_color_class,
    --linebreak--,
    background_image,
    background_image_options,
';
