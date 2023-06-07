<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die('Access denied.');

ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'header',
    'header_class',
    'after:header_layout'
);
ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'headers',
    'header_class',
    'after:header_layout'
);
ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'header',
    'subheader_class',
    'after:subheader'
);
ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'headers',
    'subheader_class',
    'after:subheader'
);

// Add Palettes for Generic usage
$GLOBALS['TCA']['tt_content']['palettes']['header_minimal'] = [
    'showitem' => '
        header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,
        --linebreak--,
        header_layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout_formlabel,
    '
];
