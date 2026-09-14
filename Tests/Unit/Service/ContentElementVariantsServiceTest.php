<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Unit\Service;

use BK2K\BootstrapPackage\DataProcessing\ContainerContextProcessor;
use BK2K\BootstrapPackage\Service\ContentElementVariantsService;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Testcase for class \BK2K\BootstrapPackage\Service\ContentElementVariantsService
 */
class ContentElementVariantsServiceTest extends UnitTestCase
{
    /**
     * One variant, so the arithmetic stays readable: gutters come off before
     * the multiplier is applied, corrections after it.
     */
    private const SETTINGS = [
        'variants' => [
            'default' => [
                'breakpoint' => 1400,
                'width' => 1200,
            ],
        ],
        'backendlayout' => [
            'default' => [
                '0' => [
                    'multiplier' => ['default' => 0.5],
                    'gutters' => ['default' => 40],
                ],
            ],
            '2_columns' => [
                '0' => [
                    'multiplier' => ['default' => 0.25],
                ],
            ],
        ],
    ];

    private function subject(): ContentElementVariantsService
    {
        return new ContentElementVariantsService(self::createStub(ContainerContextProcessor::class));
    }

    private function contentObject(string $pagelayout, int $colPos = 0): ContentObjectRenderer
    {
        $contentObject = self::createStub(ContentObjectRenderer::class);
        $contentObject->method('getData')->willReturn($pagelayout);
        $contentObject->data = ['colPos' => $colPos];

        return $contentObject;
    }

    public function testNarrowWithoutConfigurationReturnsVariantsUnchanged(): void
    {
        $variants = ['default' => ['breakpoint' => 1400, 'width' => 1200]];

        self::assertSame($variants, $this->subject()->narrow($variants, null));
    }

    public function testNarrowRemovesGuttersBeforeApplyingTheMultiplier(): void
    {
        $variants = ['default' => ['breakpoint' => 1400, 'width' => 1200]];
        $result = $this->subject()->narrow($variants, [
            'multiplier' => ['default' => 0.5],
            'gutters' => ['default' => 40],
        ]);

        self::assertSame(580, $result['default']['width']);
    }

    public function testGetVariantsNarrowsByTheBackendLayoutColumn(): void
    {
        $result = $this->subject()->getVariants(self::SETTINGS, $this->contentObject('2_columns'));

        self::assertSame(300, $result['default']['width']);
    }

    public function testGetVariantsStripsThePagetsPrefix(): void
    {
        $result = $this->subject()->getVariants(self::SETTINGS, $this->contentObject('pagets__2_columns'));

        self::assertSame(300, $result['default']['width']);
    }

    /**
     * The backendlayout TypoScript object carries ifEmpty = default, so a page
     * without a layout has to reach the same configuration here.
     */
    public function testGetVariantsFallsBackToTheDefaultBackendLayout(): void
    {
        $result = $this->subject()->getVariants(self::SETTINGS, $this->contentObject(''));

        self::assertSame(580, $result['default']['width']);
    }

    public function testGetVariantsLeavesVariantsUntouchedForAnUnconfiguredColumn(): void
    {
        $result = $this->subject()->getVariants(self::SETTINGS, $this->contentObject('2_columns', 2));

        self::assertSame(1200, $result['default']['width']);
    }
}
