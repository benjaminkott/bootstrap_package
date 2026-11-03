<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\Utility;

use BK2K\BootstrapPackage\Utility\SvgUtility;
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
        'typo3conf/ext/demo_package',
    ];

    /**
     * Adobe tools write their metadata with a namespace taken from an
     * entity, which libxml warns about without failing to parse.
     */
    #[Test]
    public function svgWithEntityNamespaceIsInlinedWithoutWarning(): void
    {
        $warnings = [];
        set_error_handler(static function (int $level, string $message) use (&$warnings): bool {
            $warnings[] = $message;
            return true;
        });
        try {
            $svg = SvgUtility::getInlineSvg('EXT:demo_package/Resources/Public/Images/Svg/SaveForWeb.svg');
        } finally {
            restore_error_handler();
        }

        self::assertSame([], $warnings);
        self::assertStringStartsWith('<svg', $svg);
        self::assertStringContainsString('<rect', $svg);
    }
}
