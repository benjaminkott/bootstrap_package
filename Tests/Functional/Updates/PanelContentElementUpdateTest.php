<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\AgencyPack\Blog\Tests\Functional\Updates;

use BK2K\BootstrapPackage\Updates\PanelContentElementUpdate;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * @extensionScannerIgnoreFile
 */
final class PanelContentElementUpdateTest extends FunctionalTestCase
{
    protected array $coreExtensionsToLoad = [
        'seo',
        'rte_ckeditor',
    ];

    protected array $testExtensionsToLoad = [
        'typo3conf/ext/bootstrap_package'
    ];

    /**
     * @test
     */
    public function noUpdateNecessaryTest(): void
    {
        $subject = new PanelContentElementUpdate();
        self::assertFalse($subject->updateNecessary());
    }

    /**
     * @test
     */
    public function updateTest(): void
    {
        $subject = new PanelContentElementUpdate();
        $this->importCSVDataSet(__DIR__ . '/Fixtures/PanelContentElementUpdate/Input.csv');
        self::assertTrue($subject->updateNecessary());
        $subject->executeUpdate();
        self::assertFalse($subject->updateNecessary());
        $this->assertCSVDataSet(__DIR__ . '/Fixtures/PanelContentElementUpdate/Result.csv');

        // Just ensure that running the upgrade again does not change anything
        $subject->executeUpdate();
        $this->assertCSVDataSet(__DIR__ . '/Fixtures/PanelContentElementUpdate/Result.csv');
    }
}
