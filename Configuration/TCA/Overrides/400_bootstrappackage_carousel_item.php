<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3_MODE') || die();

// Activate T3EDITOR if extension is activated
if (TYPO3_MODE === 'BE' && ExtensionManagementUtility::isLoaded('t3editor')) {
    $GLOBALS['TCA']['tx_bootstrappackage_carousel_item']['types']['html']['columnsOverrides'] = [
        'bodytext' => [
            'config' => [
                'renderType' => 't3editor',
                'wrap' => 'off',
                'format' => 'html'
            ]
        ]
    ];
}
