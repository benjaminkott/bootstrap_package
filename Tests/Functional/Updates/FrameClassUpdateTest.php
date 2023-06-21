<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\AgencyPack\Blog\Tests\Functional\Updates;

use BK2K\BootstrapPackage\Updates\FrameClassUpdate;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * @extensionScannerIgnoreFile
 */
final class FrameClassUpdateTest extends FunctionalTestCase
{
    protected $testExtensionsToLoad = [
        'typo3conf/ext/bootstrap_package'
    ];

    /**
     * @test
     */
    public function noUpdateNecessaryTest(): void
    {
        $subject = new FrameClassUpdate();
        self::assertFalse($subject->updateNecessary());
    }

    /**
     * @test
     */
    public function updateTest(): void
    {
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tt_content');
        $connection->executeQuery('ALTER TABLE tt_content ADD section_frame int(11) unsigned DEFAULT "0" NOT NULL;');

        $subject = new FrameClassUpdate();
        $this->importCSVDataSet(__DIR__ . '/Fixtures/FrameClassUpdate/Input.csv');
        self::assertTrue($subject->updateNecessary());
        $subject->executeUpdate();
        self::assertFalse($subject->updateNecessary());
        $this->assertCSVDataSet(__DIR__ . '/Fixtures/FrameClassUpdate/Result.csv');

        // Just ensure that running the upgrade again does not change anything
        $subject->executeUpdate();
        $this->assertCSVDataSet(__DIR__ . '/Fixtures/FrameClassUpdate/Result.csv');
    }
}
