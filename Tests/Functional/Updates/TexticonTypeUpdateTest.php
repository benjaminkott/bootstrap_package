<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\Updates;

use BK2K\BootstrapPackage\Updates\TexticonTypeUpdate;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * @extensionScannerIgnoreFile
 */
final class TexticonTypeUpdateTest extends FunctionalTestCase
{
    protected array $coreExtensionsToLoad = [
        'seo',
        'rte_ckeditor',
    ];

    protected array $testExtensionsToLoad = [
        'typo3conf/ext/bootstrap_package',
    ];

    #[Test]
    public function noUpdateNecessaryTest(): void
    {
        $subject = new TexticonTypeUpdate();
        self::assertFalse($subject->updateNecessary());
    }

    #[Test]
    public function updateTest(): void
    {
        $subject = new TexticonTypeUpdate();
        $this->importCSVDataSet(__DIR__ . '/Fixtures/TexticonTypeUpdate/Input.csv');
        self::assertTrue($subject->updateNecessary());
        $subject->executeUpdate();
        self::assertFalse($subject->updateNecessary());
        $this->assertCSVDataSet(__DIR__ . '/Fixtures/TexticonTypeUpdate/Result.csv');

        // Just ensure that running the upgrade again does not change anything
        $subject->executeUpdate();
        $this->assertCSVDataSet(__DIR__ . '/Fixtures/TexticonTypeUpdate/Result.csv');
    }
}
