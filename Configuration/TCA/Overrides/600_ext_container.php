<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

// Activate extension container if extension is activated
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('container')) {
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\B13\Container\Tca\Registry::class)->configureContainer(
        (
            new \B13\Container\Tca\ContainerConfiguration(
                'container_1_columns',
                'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.container_1_columns.name',
                '',
                [
                    [
                        [
                            'name' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.column.middle',
                            'colPos' => 201
                        ]
                    ]
                ]
            )
        )->setIcon('EXT:bootstrap_package/Resources/Public/Icons/ContentElements/container-columns-1.svg')
    );
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\B13\Container\Tca\Registry::class)->configureContainer(
        (
            new \B13\Container\Tca\ContainerConfiguration(
                'container_2_columns',
                'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.container_2_columns.name',
                '',
                [
                    [
                        [
                            'name' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.column.left',
                            'colPos' => 201
                        ],
                        [
                            'name' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.column.right',
                            'colPos' => 202
                        ]
                    ]
                ]
            )
        )->setIcon('EXT:bootstrap_package/Resources/Public/Icons/ContentElements/container-columns-2.svg')
    );
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\B13\Container\Tca\Registry::class)->configureContainer(
        (
            new \B13\Container\Tca\ContainerConfiguration(
                'container_2_columns_right',
                'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.container_2_columns_right.name',
                '',
                [
                    [
                        [
                            'name' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.column.left',
                            'colspan' => 1,
                            'colPos' => 201
                        ],
                        [
                            'name' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.column.right',
                            'colspan' => 3,
                            'colPos' => 202
                        ]
                    ]
                ]
            )
        )->setIcon('EXT:bootstrap_package/Resources/Public/Icons/ContentElements/container-columns-2-right.svg')
    );
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\B13\Container\Tca\Registry::class)->configureContainer(
        (
            new \B13\Container\Tca\ContainerConfiguration(
                'container_2_columns_left',
                'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.container_2_columns_left.name',
                '',
                [
                    [
                        [
                            'name' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.column.left',
                            'colspan' => 3,
                            'colPos' => 201
                        ],
                        [
                            'name' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.column.right',
                            'colspan' => 2,
                            'colPos' => 202
                        ]
                    ]
                ]
            )
        )->setIcon('EXT:bootstrap_package/Resources/Public/Icons/ContentElements/container-columns-2-left.svg')
    );
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\B13\Container\Tca\Registry::class)->configureContainer(
        (
            new \B13\Container\Tca\ContainerConfiguration(
                'container_3_columns',
                'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.container_3_columns.name',
                '',
                [
                    [
                        [
                            'name' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.column.left',
                            'colPos' => 201
                        ],
                        [
                            'name' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.column.middle',
                            'colPos' => 203
                        ],
                        [
                            'name' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.column.right',
                            'colPos' => 202
                        ]
                    ]
                ]
            )
        )->setIcon('EXT:bootstrap_package/Resources/Public/Icons/ContentElements/container-columns-3.svg')
    );
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\B13\Container\Tca\Registry::class)->configureContainer(
        (
            new \B13\Container\Tca\ContainerConfiguration(
                'container_4_columns',
                'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.container_4_columns.name',
                '',
                [
                    [
                        [
                            'name' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.column.left',
                            'colPos' => 201
                        ],
                        [
                            'name' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.column.middle_left',
                            'colPos' => 203
                        ],
                        [
                            'name' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.column.middle_right',
                            'colPos' => 204
                        ],
                        [
                            'name' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:container.column.right',
                            'colPos' => 202
                        ]
                    ]
                ]
            )
        )->setIcon('EXT:bootstrap_package/Resources/Public/Icons/ContentElements/container-columns-4.svg')
    );
}
