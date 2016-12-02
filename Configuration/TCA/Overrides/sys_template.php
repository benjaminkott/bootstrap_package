<?php
defined('TYPO3_MODE') || die();

/***************
 * Default TypoScript
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'bootstrap_package',
    'Configuration/TypoScript',
    'Bootstrap Package'
);
