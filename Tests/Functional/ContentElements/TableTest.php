<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\ContentElements;

use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Configuration\SiteWriter;
use TYPO3\TestingFramework\Core\Functional\Framework\Frontend\InternalRequest;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Testcase for the rendered cells of the table content element
 *
 * @see Resources/Private/Partials/ContentElements/Table/Columns.html
 */
final class TableTest extends FunctionalTestCase
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

        $this->importCSVDataSet(__DIR__ . '/Fixtures/Table/pages.csv');
        $this->importCSVDataSet(__DIR__ . '/Fixtures/Table/tt_content.csv');

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
            'EXT:bootstrap_package/Tests/Functional/ContentElements/Fixtures/Table/setup.typoscript',
        ]);
    }

    /**
     * The row is "0||text": a cell carrying a zero, an empty cell and a cell
     * carrying a word. A zero is falsy, so a condition on the cell alone drops
     * it and the empty-cell fallback takes its place.
     */
    #[Test]
    public function cellCarryingAZeroIsRendered(): void
    {
        self::assertStringContainsString(
            '<td>0</td>',
            $this->renderFrontendPage(1)
        );
    }

    #[Test]
    public function emptyCellFallsBackToANonBreakingSpace(): void
    {
        self::assertStringContainsString(
            '<td>&nbsp;</td>',
            $this->renderFrontendPage(1)
        );
    }

    /**
     * The template indents every cell across several lines, which says nothing
     * about the rendered table, so the whitespace between the tags is removed
     * before the assertions read it.
     */
    private function renderFrontendPage(int $pageId): string
    {
        $response = $this->executeFrontendSubRequest(
            new InternalRequest('http://localhost/index.php?id=' . $pageId)
        );
        self::assertSame(200, $response->getStatusCode());

        return (string)preg_replace('/\s*(<[^>]++>)\s*/', '$1', (string)$response->getBody());
    }
}
