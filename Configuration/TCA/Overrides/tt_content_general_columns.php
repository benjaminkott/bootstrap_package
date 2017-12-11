<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') || die();

/***************
 * Adjust columns for generic usage
 */
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
$GLOBALS['TCA']['tt_content']['columns']['tx_bootstrappackage_carousel_item'] = [
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
            'mode' => 'select',
            'localizeChildrenAtParentLocalization' => true,
        ]
    ]
];

/***************
 * Add additional frame class items
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'frame_class',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.frame_class.well',
        'well'
    ],
    'indent-right',
    'after'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'frame_class',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.frame_class.jumbotron',
        'jumbotron'
    ],
    'well',
    'after'
);
