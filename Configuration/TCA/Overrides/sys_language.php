<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

if (!\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('sites')) {
    /***************
     * Register fields
     */
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'sys_language',
        [
            'nav_title' => [
                'exclude' => true,
                'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.nav_title',
                'config' => [
                    'type' => 'input',
                    'size' => 50,
                    'max' => 255,
                    'eval' => 'trim'
                ]
            ],
            'locale' => [
                'exclude' => true,
                'label' => 'locale',
                'config' => [
                    'type' => 'input',
                    'size' => 35,
                    'max' => 20,
                    'eval' => 'trim,required'
                ]
            ],
            'hreflang' => [
                'exclude' => true,
                'label' => 'hreflang',
                'config' => [
                    'type' => 'input',
                    'size' => 35,
                    'max' => 20,
                    'eval' => 'trim,required'
                ]
            ],
            'direction' => [
                'label' => 'direction',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        ['None', '', ''],
                        ['Left to right', 'ltr', ''],
                        ['Right to left', 'rtl', '']
                    ],
                    'size' => 1,
                    'minitems' => 1,
                    'maxitems' => 1,
                    'fieldWizard' => [
                        'selectIcons' => [
                            'disabled' => false,
                        ],
                    ],
                ]
            ]
        ]
    );

    /***************
     * Assign position to fields
     */
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_language', 'nav_title,locale,hreflang,direction', '', 'after:title');
}
