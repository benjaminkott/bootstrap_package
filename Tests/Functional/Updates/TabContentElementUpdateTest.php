<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\AgencyPack\Blog\Tests\Functional\Updates;

use BK2K\BootstrapPackage\Updates\TabContentElementUpdate;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * @extensionScannerIgnoreFile
 */
final class TabContentElementUpdateTest extends FunctionalTestCase
{
    protected array $testExtensionsToLoad = [
        'typo3conf/ext/bootstrap_package'
    ];

    /**
     * @test
     */
    public function noUpdateNecessaryTest(): void
    {
        $subject = new TabContentElementUpdate();
        self::assertFalse($subject->updateNecessary());
    }

    /**
     * @test
     */
    public function updateTest(): void
    {
        $subject = new TabContentElementUpdate();
        $this->importCSVDataSet(__DIR__ . '/Fixtures/TabContentElementUpdate/Input.csv');
        self::assertTrue($subject->updateNecessary());
        $subject->executeUpdate();
        self::assertFalse($subject->updateNecessary());
        $this->assertCSVDataSet(__DIR__ . '/Fixtures/TabContentElementUpdate/Result.csv');

        // Just ensure that running the upgrade again does not change anything
        $subject->executeUpdate();
        $this->assertCSVDataSet(__DIR__ . '/Fixtures/TabContentElementUpdate/Result.csv');
    }
}
