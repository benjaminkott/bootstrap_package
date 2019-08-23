<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3_MODE') || die();

/***************
 * TypoScript: Full Package
 * This includes the full setup including all configurations
 */
ExtensionManagementUtility::addStaticFile(
    'bootstrap_package',
    'Configuration/TypoScript',
    'Bootstrap Package: Full Package'
);

/***************
 * TypoScript: Content Elements
 * Include only the configuration for content elements
 */
ExtensionManagementUtility::addStaticFile(
    'bootstrap_package',
    'Configuration/TypoScript/ContentElement',
    'Bootstrap Package: Content Elements'
);

/***************
 * TypoScript: Framework
 * Include Bootstrap 3.x (LESS) Assets
 */
ExtensionManagementUtility::addStaticFile(
    'bootstrap_package',
    'Configuration/TypoScript/Bootstrap3',
    'Bootstrap Package: Bootstrap 3.x (LESS)'
);

/***************
 * TypoScript: Framework
 * Include Bootstrap 4.x (SCSS) Assets
 */
ExtensionManagementUtility::addStaticFile(
    'bootstrap_package',
    'Configuration/TypoScript/Bootstrap4',
    'Bootstrap Package: Bootstrap 4.x (SCSS)'
);
