<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

/**
 * Default TypoScript for DemoPackage
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'demo_package',
    'Configuration/TypoScript',
    'Demo Package'
);
