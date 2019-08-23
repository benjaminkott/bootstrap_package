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
 * Temporary variables
 */
$extensionKey = 'bootstrap_package';

/***************
 * Register PageTS
 */

// BackendLayouts
ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/TsConfig/Page/Mod/WebLayout/BackendLayouts.tsconfig',
    'Bootstrap Package: Backend Layouts'
);

// TCEMAIN
ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/TsConfig/Page/TCEMAIN.tsconfig',
    'Bootstrap Package: TCEMAIN'
);

// TCEFORM
ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/TsConfig/Page/TCEFORM.tsconfig',
    'Bootstrap Package: TCEFORM'
);

// Content Elements
ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/TsConfig/Page/ContentElement/All.tsconfig',
    'Bootstrap Package: All Content Elements'
);
ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/TsConfig/Page/ContentElement/Categories.tsconfig',
    'Bootstrap Package: Categories for Content Elements'
);

/***************
 * Register fields
 */
$GLOBALS['TCA']['pages']['columns'] = array_replace_recursive(
    $GLOBALS['TCA']['pages']['columns'],
    [
        'nav_icon' => TcaUtility::getIcon(
            'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:pages.nav_icon',
            'nav_icon'
        ),
        'thumbnail' => TcaUtility::getSimpleImage(
            'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:pages.thumbnail',
            'thumbnail'
        )
    ]
);

/***************
 * Assign position to fields
 */
ExtensionManagementUtility::addToAllTCAtypes('pages', 'nav_icon', '1,3,4', 'after:nav_title');
ExtensionManagementUtility::addToAllTCAtypes('pages', 'thumbnail', '1,3,4', 'after:backend_layout_next_level');
