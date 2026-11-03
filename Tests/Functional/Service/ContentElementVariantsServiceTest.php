<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\Service;

use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Configuration\SiteWriter;
use TYPO3\TestingFramework\Core\Functional\Framework\Frontend\InternalRequest;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Testcase for \BK2K\BootstrapPackage\Service\ContentElementVariantsService
 * against the settings this package ships.
 *
 * The widths are the ones the content element layout arrives at for the same
 * element, so a plugin that asks the service is handed what a template would
 * have been handed. They are read out of a frontend request rather than
 * calculated here: a stub cannot say what getData('pagelayout') resolves to.
 */
final class ContentElementVariantsServiceTest extends FunctionalTestCase
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

    protected function setUp(): void
    {
        parent::setUp();

        $this->importCSVDataSet(__DIR__ . '/Fixtures/ContentElementVariants/pages.csv');
        $this->importCSVDataSet(__DIR__ . '/Fixtures/ContentElementVariants/tt_content.csv');

        $this->get(SiteWriter::class)->write('bootstrap-package-test', [
            'rootPageId' => 1,
            'base' => 'http://localhost/',
            'languages' => [
                [
                    'title' => 'English',
                    'enabled' => true,
                    'languageId' => 0,
                    'base' => '/',
                    'locale' => 'en_US.UTF-8',
                    'navigationTitle' => 'English',
                    'flag' => 'us',
                ],
            ],
        ]);
        $this->get(CacheManager::class)->flushCaches();

        $this->setUpFrontendRootPage(1, [
            'EXT:bootstrap_package/Tests/Functional/Service/Fixtures/ContentElementVariants/setup.typoscript',
        ]);
    }

    /**
     * Column 0 of "2_columns" carries multiplier 0.75 and gutter 40 for
     * default, xlarge and large, so 1280 becomes (1280 - 40) * 0.75. The
     * tiers the column does not configure keep the width they started with.
     */
    #[Test]
    public function narrowsByTheColumnOfTheBackendLayoutThePageCarries(): void
    {
        self::assertStringContainsString(
            '[1:default=930,xlarge=795,large=660,medium=680,small=500,extrasmall=374]',
            $this->render(1)
        );
    }

    /**
     * A page without a backend layout resolves to "default", where column 0
     * is not configured — nothing narrows, and the base variants stand.
     */
    #[Test]
    public function leavesTheVariantsAloneForAnUnconfiguredColumn(): void
    {
        self::assertStringContainsString(
            '[2:default=1280,xlarge=1100,large=920,medium=680,small=500,extrasmall=374]',
            $this->render(2)
        );
    }

    /**
     * The same page, in a footer column that "default" does configure. This
     * is what ifEmpty = default on the backendlayout TypoScript object buys:
     * without it an empty pagelayout would reach no configuration at all and
     * this element would keep the full width.
     */
    #[Test]
    public function resolvesAnEmptyPageLayoutToTheDefaultBackendLayout(): void
    {
        self::assertStringContainsString(
            '[3:default=400,xlarge=340,large=280,medium=200,small=500,extrasmall=374]',
            $this->render(2)
        );
    }

    private function render(int $pageId): string
    {
        $response = $this->executeFrontendSubRequest(
            new InternalRequest('http://localhost/index.php?id=' . $pageId)
        );
        self::assertSame(200, $response->getStatusCode());

        return (string)$response->getBody();
    }
}
