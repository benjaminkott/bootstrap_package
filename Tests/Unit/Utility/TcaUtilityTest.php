<?php
declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Unit\Utility;

use BK2K\BootstrapPackage\Utility\TcaUtility;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Testcase for class {@link TcaUtility}
 */
final class TcaUtilityTest extends UnitTestCase
{
    /**
     * @test
     */
    public function getConfigForFileExtensionsReturnsConfigArrayForTypo3V12(): void
    {
        if ((new Typo3Version())->getMajorVersion() < 12) {
            self::markTestSkipped('Test can only be executed in TYPO3 v12');
        }

        $expected = [
            'allowed' => 'jpg,png',
            'disallowed' => 'gif,youtube',
        ];

        self::assertSame(
            $expected,
            TcaUtility::getConfigForFileExtensions(['jpg', 'png'], ['gif', 'youtube'])
        );
    }

    /**
     * @test
     */
    public function getConfigForFileExtensionsReturnsConfigArrayForTypo3V11(): void
    {
        if ((new Typo3Version())->getMajorVersion() >= 12) {
            self::markTestSkipped('Test can only be executed in TYPO3 v11');
        }

        $expected = [
            'filter' => [
                0 => [
                    'parameters' => [
                        'allowedFileExtensions' => 'jpg,png',
                        'disallowedFileExtensions' => 'gif,youtube',
                    ],
                ],
            ],
            'overrideChildTca' => [
                'columns' => [
                    'uid_local' => [
                        'config' => [
                            'appearance' => [
                                'elementBrowserAllowed' => 'jpg,png',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        self::assertSame(
            $expected,
            TcaUtility::getConfigForFileExtensions(['jpg', 'png'], ['gif', 'youtube'])
        );
    }
}
