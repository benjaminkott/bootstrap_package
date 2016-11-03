<?php
defined('TYPO3_MODE') or die();

/***************
 * Default TypoScript
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'bootstrap_package',
    'Configuration/TypoScript',
    'Bootstrap Package'
);
