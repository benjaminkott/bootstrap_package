<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

// Add Content Element
if (!is_array($GLOBALS['TCA']['tt_content']['types']['media'] ?? false)) {
    $GLOBALS['TCA']['tt_content']['types']['media'] = [];
}

// Add content element to selector list
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.media',
        'description' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.media.description',
        'value' => 'media',
        'icon' => 'mimetypes-x-content-multimedia',
        'group' => 'bootstrap_package',
    ],
    'listgroup',
    'after'
);

// Assign Icon
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['media'] = 'mimetypes-x-content-multimedia';

// Configure element type
$GLOBALS['TCA']['tt_content']['types']['media'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['media'],
    [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;core.form.palettes:general;general,
                --palette--;core.form.palettes:headers;headers,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.media,
                assets,
                file_folder,
                filelink_sorting,
                --palette--;core.form.palettes:media_adjustments;mediaAdjustments,
                --palette--;core.form.palettes:settings_gallery;gallerySettings,
                --palette--;core.form.palettes:media_behaviour;imagelinks,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;core.form.palettes:content_layout;frames,
                --palette--;core.form.palettes:links_appearance;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;core.form.palettes:access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        ',
        'columnsOverrides' => [
            'assets' => [
                'config' => [
                    'allowed' => ['youtube', 'vimeo'],
                ],
            ],
        ],
    ]
);
