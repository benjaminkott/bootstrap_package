<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die('Access denied.');

$GLOBALS['TCA']['tx_bootstrappackage_carousel_item']['types']['html']['columnsOverrides'] = [
    'bodytext' => [
        'config' => [
            'renderType' => 'codeEditor',
            'wrap' => 'off',
            'format' => 'html',
        ],
    ],
];
