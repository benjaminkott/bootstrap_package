<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\Utility;

use BK2K\BootstrapPackage\Utility\SvgUtility;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Testcase for class \BK2K\BootstrapPackage\Utility\SvgUtility
 */
final class SvgUtilityTest extends FunctionalTestCase
{
    protected array $coreExtensionsToLoad = [
        'seo',
        'rte_ckeditor',
        'extensionmanager',
        'install',
    ];

    protected array $testExtensionsToLoad = [
        'typo3conf/ext/bootstrap_package',
    ];

    public static function packageResourcesAreInlinedDataProvider(): array
    {
        return [
            'EXT' => ['EXT:bootstrap_package/Resources/Public/Images/Icons/Glyphicons/adjust.svg'],
            'PKG' => ['PKG:bk2k/bootstrap-package:Resources/Public/Images/Icons/Glyphicons/adjust.svg'],
        ];
    }

    /**
     * Files shipped with a package are not part of any file storage.
     */
    #[DataProvider('packageResourcesAreInlinedDataProvider')]
    #[Test]
    public function packageResourcesAreInlined(string $src): void
    {
        $svg = SvgUtility::getInlineSvg($src, null, 16, 16, 'icon');

        self::assertStringStartsWith('<svg', $svg);
        self::assertStringContainsString('class="icon"', $svg);
        self::assertStringContainsString('width="16"', $svg);
        self::assertStringContainsString('aria-hidden="true"', $svg);
    }

    #[Test]
    public function missingPackageResourceThrows(): void
    {
        $this->expectExceptionCode(1530601100);

        SvgUtility::getInlineSvg('EXT:bootstrap_package/Resources/Public/Images/Icons/Glyphicons/missing.svg');
    }
}
