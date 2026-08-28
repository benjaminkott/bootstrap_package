<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\Fluid;

use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Configuration\SiteWriter;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\TestingFramework\Core\Functional\Framework\Frontend\InternalRequest;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Testcase for the pagination view helpers
 *
 * @see Classes/ViewHelpers/Data/PaginateViewHelper.php
 * @see Classes/ViewHelpers/Link/PaginateViewHelper.php
 */
final class PaginationTest extends FunctionalTestCase
{
    private const BASE = 'http://localhost/';

    protected array $coreExtensionsToLoad = [
        'seo',
        'rte_ckeditor',
        'extensionmanager',
        'install',
    ];

    protected array $testExtensionsToLoad = [
        'typo3conf/ext/bootstrap_package',
    ];

    /**
     * Pagination arguments are handed over by hand here, and a missing cHash
     * must render the page uncached instead of answering with a 404.
     */
    protected array $configurationToUseInTestInstance = [
        'FE' => [
            'pageNotFoundOnCHashError' => false,
        ],
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->importCSVDataSet(__DIR__ . '/Fixtures/Pagination/pages.csv');

        $this->writeSite();

        $this->get(CacheManager::class)->flushCaches();

        $this->setUpFrontendRootPage(1, [
            'EXT:bootstrap_package/Tests/Functional/Fluid/Fixtures/Pagination/setup.typoscript',
        ]);
    }

    #[Test]
    public function paginationLinksCarryTheIdentifierAsAQueryValue(): void
    {
        $link = $this->pageLink($this->renderPage('/'), 'c1', '2');

        self::assertStringContainsString('paginate[id]=gallery-1', urldecode($link));
        self::assertStringContainsString('paginate[page]=2', urldecode($link));
    }

    /**
     * The identifier travels as a value, so a single pagination is addressed at
     * a time — every other one on the page stays on its first page.
     */
    #[Test]
    public function onlyTheAddressedPaginationLeavesItsFirstPage(): void
    {
        $markup = $this->renderPage($this->pageLink($this->renderPage('/'), 'c2', '2'));

        self::assertStringContainsString('<p>gamma</p>', $this->block($markup, 'c2'));
        self::assertStringContainsString('<p>one</p>', $this->block($markup, 'c1'));
    }

    /**
     * Nothing but the link view helper writes the pagination arguments, so the
     * way back to the first page is a link to the page itself.
     */
    #[Test]
    public function theFirstPageIsLinkedWithoutPaginationArguments(): void
    {
        $secondPage = $this->renderPage($this->pageLink($this->renderPage('/'), 'c2', '2'));
        $link = $this->pageLink($secondPage, 'c2', '1');

        self::assertStringNotContainsString('paginate', $link);
        self::assertStringStartsWith('/', $link);
    }

    /**
     * Every pagination link jumps to the top of the element it pages, so the
     * new page starts where the reader is looking.
     */
    #[Test]
    public function paginationLinksJumpToTheElementTheyPage(): void
    {
        $link = $this->pageLink($this->renderPage('/'), 'c2', '2');

        self::assertStringEndsWith('#c2', $link);
    }

    /**
     * The page number arrives as a query argument and the paginator refuses
     * anything below one.
     */
    #[Test]
    public function pageNumbersBelowOneFallBackToTheFirstPage(): void
    {
        $markup = $this->renderPage('/?paginate%5Bid%5D=gallery-1&paginate%5Bpage%5D=0');

        self::assertStringContainsString('<p>one</p>', $this->block($markup, 'c1'));
    }

    /**
     * The identifier is a value, so the shipped enhancer addresses every
     * pagination on the site without knowing any uid.
     */
    #[Test]
    public function theShippedSetRewritesPaginationLinks(): void
    {
        if ((new Typo3Version())->getMajorVersion() < 14) {
            self::markTestSkipped('Route enhancers in site sets need TYPO3 v14.1');
        }
        $this->writeSite(['bootstrap-package/pagination']);

        $link = $this->pageLink($this->renderPage('/'), 'c2', '2');
        self::assertSame('/gallery-2/page-2#c2', $link);

        $markup = $this->renderPage($link);
        self::assertStringContainsString('<p>delta</p>', $this->block($markup, 'c2'));
        self::assertStringContainsString('<p>one</p>', $this->block($markup, 'c1'));
        self::assertSame('/#c2', $this->pageLink($markup, 'c2', '1'));
    }

    private function writeSite(array $dependencies = []): void
    {
        $this->get(SiteWriter::class)->write('bootstrap-package-pagination', [
            'rootPageId' => 1,
            'base' => self::BASE,
            'dependencies' => $dependencies,
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
    }

    private function renderPage(string $url): string
    {
        $response = $this->executeFrontendSubRequest(new InternalRequest(self::BASE . ltrim($url, '/')));
        self::assertSame(200, $response->getStatusCode());

        return (string)$response->getBody();
    }

    /**
     * Markup of the paginated element, up to the closing tag of the wrapping
     * div in the fixture template.
     */
    private function block(string $markup, string $element): string
    {
        $start = strpos($markup, '<div id="' . $element . '">');
        self::assertIsInt($start, 'Element "' . $element . '" is not part of the rendered page.');
        $end = strpos($markup, '</div>', $start);
        self::assertIsInt($end);

        return substr($markup, $start, $end - $start);
    }

    /**
     * Target of the link labelled with the given page number.
     */
    private function pageLink(string $markup, string $element, string $label): string
    {
        $pattern = '~<a\b[^>]*href="([^"]*)"[^>]*>\s*<span class="page-link-title">' . preg_quote($label, '~') . '</span>~';
        self::assertSame(1, preg_match($pattern, $this->block($markup, $element), $matches), 'Element "' . $element . '" has no link to page ' . $label . '.');

        return html_entity_decode($matches[1]);
    }
}
