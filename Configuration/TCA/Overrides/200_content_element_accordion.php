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

/***************
 * Add Content Element
 */
if (!is_array($GLOBALS['TCA']['tt_content']['types']['accordion'])) {
    $GLOBALS['TCA']['tt_content']['types']['accordion'] = [];
}

/***************
 * Add content element PageTSConfig
 */
ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/TsConfig/Page/ContentElement/Element/Accordion.tsconfig',
    'Bootstrap Package Content Element: Accordion'
);

/***************
 * Add content element to selector list
 */
ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.accordion',
        'accordion',
        'content-bootstrappackage-accordion'
    ],
    '--div--',
    'after'
);

/***************
 * Assign Icon
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['accordion'] = 'content-bootstrappackage-accordion';

/***************
 * Configure element type
 */
$GLOBALS['TCA']['tt_content']['types']['accordion'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['accordion'],
    [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
                tx_bootstrappackage_accordion_item,
            --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:accordion.options,
                pi_flexform;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:advanced,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        '
    ]
);

/***************
 * Register fields
 */
$GLOBALS['TCA']['tt_content']['columns'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['columns'],
    [
        'tx_bootstrappackage_accordion_item' => TcaUtility::getInlineRelation(
            'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:accordion_item',
            'tx_bootstrappackage_accordion_item',
            'tt_content'
        )
    ]
);

/***************
 * Add flexForms for content element configuration
 */
ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:bootstrap_package/Configuration/FlexForms/Accordion.xml',
    'accordion'
);
