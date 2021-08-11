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
                '1 Column',
                '',
                [
                    [
                        [
                            'name' => 'Middle',
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
                '2 Columns 50%/50%',
                '',
                [
                    [
                        [
                            'name' => 'Left',
                            'colPos' => 201
                        ],
                        [
                            'name' => 'Right',
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
                '2 Columns 25%/75%',
                '',
                [
                    [
                        [
                            'name' => 'Left',
                            'colspan' => 1,
                            'colPos' => 201
                        ],
                        [
                            'name' => 'Right',
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
                '2 Columns 75%/25%',
                '',
                [
                    [
                        [
                            'name' => 'Left',
                            'colspan' => 3,
                            'colPos' => 201
                        ],
                        [
                            'name' => 'Right',
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
                '3 Columns',
                '',
                [
                    [
                        [
                            'name' => 'Left',
                            'colPos' => 201
                        ],
                        [
                            'name' => 'Middle',
                            'colPos' => 203
                        ],
                        [
                            'name' => 'Right',
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
                '4 Columns',
                '',
                [
                    [
                        [
                            'name' => 'Left',
                            'colPos' => 201
                        ],
                        [
                            'name' => 'Middle Left',
                            'colPos' => 203
                        ],
                        [
                            'name' => 'Middle Right',
                            'colPos' => 204
                        ],
                        [
                            'name' => 'Right',
                            'colPos' => 202
                        ]
                    ]
                ]
            )
        )->setIcon('EXT:bootstrap_package/Resources/Public/Icons/ContentElements/container-columns-4.svg')
    );
}
