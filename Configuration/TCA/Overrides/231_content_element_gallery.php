<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

// Add Content Element
if (!is_array($GLOBALS['TCA']['tt_content']['types']['gallery'] ?? false)) {
    $GLOBALS['TCA']['tt_content']['types']['gallery'] = [];
}

// Add content element PageTSConfig
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    'bootstrap_package',
    'Configuration/TsConfig/Page/ContentElement/Element/Gallery.tsconfig',
    'Bootstrap Package Content Element: Gallery'
);

// Add content element to selector list
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.gallery',
        'gallery',
        'content-bootstrappackage-gallery',
        'bootstrap_package'
    ],
    'external_media',
    'after'
);

// Assign Icon
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['gallery'] = 'content-bootstrappackage-gallery';

// Configure element type
$GLOBALS['TCA']['tt_content']['types']['gallery'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['gallery'],
    [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;;general,
                --palette--;;headers,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.images,
                image,
                file_folder,
                filelink_sorting,
                --palette--;;mediaAdjustments,
                --palette--;;gallerySettings,
                --palette--;;imagelinks,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;;frames,
                --palette--;;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended
        '
    ]
);

// Add additional fields
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    'aspect_ratio, items_per_page',
    'gallery',
    'after:imagecols'
);
