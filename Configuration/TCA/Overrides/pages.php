<?php
defined('TYPO3_MODE') || die();

/***************
 * Temporary variables
 */
$extensionKey = 'bootstrap_package';

/***************
 * Register PageTS
 */

// Ionicons
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/PageTS/Feature/Ionicons.txt',
    'Bootstrap Package: Use Ionicons as Iconset'
);

// BackendLayouts
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/PageTS/Mod/WebLayout/BackendLayouts.txt',
    'Bootstrap Package: Backend Layouts'
);

// TCEMAIN
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/PageTS/TCEMAIN.txt',
    'Bootstrap Package: TCEMAIN'
);

// TCEFORM
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/PageTS/TCEFORM.txt',
    'Bootstrap Package: TCEFORM'
);

// TtContent Previews
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/PageTS/Mod/WebLayout/TtContent/preview.txt',
    'Bootstrap Package: Content Previews'
);

// New Content element wizards
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    $extensionKey,
    'Configuration/PageTS/Mod/Wizards/newContentElement.txt',
    'Bootstrap Package: New Content Element Wizards'
);
