<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

// Add content element group to selector list
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItemGroup(
    'tt_content',
    'CType',
    'bootstrap_package',
    'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:theme_name',
    'after:default'
);

$GLOBALS['TCA']['tt_content']['types']['accordion']['columnsOverrides']['pi_flexform']['config']['ds'] = 'FILE:EXT:bootstrap_package/Configuration/FlexForms/Accordion.xml';
$GLOBALS['TCA']['tt_content']['types']['card_group']['columnsOverrides']['pi_flexform']['config']['ds'] = 'FILE:EXT:bootstrap_package/Configuration/FlexForms/CardGroup.xml';
$GLOBALS['TCA']['tt_content']['types']['carousel']['columnsOverrides']['pi_flexform']['config']['ds'] = 'FILE:EXT:bootstrap_package/Configuration/FlexForms/Carousel.xml';
$GLOBALS['TCA']['tt_content']['types']['carousel_small']['columnsOverrides']['pi_flexform']['config']['ds'] = 'FILE:EXT:bootstrap_package/Configuration/FlexForms/Carousel.xml';
$GLOBALS['TCA']['tt_content']['types']['carousel_fullscreen']['columnsOverrides']['pi_flexform']['config']['ds'] = 'FILE:EXT:bootstrap_package/Configuration/FlexForms/Carousel.xml';
$GLOBALS['TCA']['tt_content']['types']['icon_group']['columnsOverrides']['pi_flexform']['config']['ds'] = 'FILE:EXT:bootstrap_package/Configuration/FlexForms/IconGroup.xml';
$GLOBALS['TCA']['tt_content']['types']['menu_card_list']['columnsOverrides']['pi_flexform']['config']['ds'] = 'FILE:EXT:bootstrap_package/Configuration/FlexForms/MenuCard.xml';
$GLOBALS['TCA']['tt_content']['types']['menu_card_dir']['columnsOverrides']['pi_flexform']['config']['ds'] = 'FILE:EXT:bootstrap_package/Configuration/FlexForms/MenuCard.xml';
$GLOBALS['TCA']['tt_content']['types']['menu_thumbnail_list']['columnsOverrides']['pi_flexform']['config']['ds'] = 'FILE:EXT:bootstrap_package/Configuration/FlexForms/MenuThumbnail.xml';
$GLOBALS['TCA']['tt_content']['types']['menu_thumbnail_dir']['columnsOverrides']['pi_flexform']['config']['ds'] = 'FILE:EXT:bootstrap_package/Configuration/FlexForms/MenuThumbnail.xml';
$GLOBALS['TCA']['tt_content']['types']['tab']['columnsOverrides']['pi_flexform']['config']['ds'] = 'FILE:EXT:bootstrap_package/Configuration/FlexForms/Tab.xml';
$GLOBALS['TCA']['tt_content']['types']['timeline']['columnsOverrides']['pi_flexform']['config']['ds'] = 'FILE:EXT:bootstrap_package/Configuration/FlexForms/Timeline.xml';
