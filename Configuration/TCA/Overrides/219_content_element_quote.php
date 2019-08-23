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
if (!is_array($GLOBALS['TCA']['tt_content']['types']['quote'])) {
    $GLOBALS['TCA']['tt_content']['types']['quote'] = [];
}

/***************
 * Add content element PageTSConfig
 */
ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/TsConfig/Page/ContentElement/Element/Quote.tsconfig',
    'Bootstrap Package Content Element: Quote'
);

/***************
 * Add content element to selector list
 */
ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.quote',
        'quote',
        'content-quote'
    ],
    'panel',
    'after'
);

/***************
 * Assign Icon
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['quote'] = 'content-quote';

/***************
 * Configure element type
 */
$GLOBALS['TCA']['tt_content']['types']['quote'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['quote'],
    [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header.ALT.div_formlabel,
                quote_link;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:quote.link,
                quote_source;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:quote.source,
                bodytext;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:quote.text,
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
        'quote_source' => TcaUtility::getText('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:quote.source'),
        'quote_link' => TcaUtility::getLink('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:quote.link')
    ]
);
