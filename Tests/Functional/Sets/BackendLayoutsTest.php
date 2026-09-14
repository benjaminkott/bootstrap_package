<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\Sets;

use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Configuration\SiteWriter;
use TYPO3\CMS\Core\Site\SiteFinder;
use TYPO3\CMS\Core\TypoScript\PageTsConfigFactory;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Testcase for the shipped page layouts
 *
 * @see Configuration/Sets/BackendLayouts/PageTsConfig/BackendLayouts/
 */
final class BackendLayoutsTest extends FunctionalTestCase
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

        $this->importCSVDataSet(__DIR__ . '/Fixtures/BackendLayouts/pages.csv');

        $this->get(SiteWriter::class)->write('bootstrap-package-layouts', [
            'rootPageId' => 1,
            'base' => 'http://localhost/',
            'dependencies' => ['bootstrap-package/backend-layouts'],
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
    }

    /**
     * The frontend resolves the content areas of a page from its layout, and
     * a column with a colPos but no identifier stops the request.
     */
    #[Test]
    public function everyContentColumnCarriesAnIdentifier(): void
    {
        $layouts = $this->shippedLayouts();
        self::assertNotEmpty($layouts);

        foreach ($layouts as $layout => $configuration) {
            foreach ($configuration['config.']['backend_layout.']['rows.'] ?? [] as $row) {
                foreach ($row['columns.'] ?? [] as $column) {
                    if (!isset($column['colPos'])) {
                        continue;
                    }
                    self::assertNotSame(
                        '',
                        (string)($column['identifier'] ?? ''),
                        'Column with colPos ' . $column['colPos'] . ' of layout "' . rtrim($layout, '.') . '" has no identifier.'
                    );
                }
            }
        }
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private function shippedLayouts(): array
    {
        $site = $this->get(SiteFinder::class)->getSiteByRootPageId(1);
        $rootLine = [['uid' => 1, 'pid' => 0, 'is_siteroot' => 1, 'tsconfig_includes' => '', 'TSconfig' => '']];
        $pageTsConfig = $this->get(PageTsConfigFactory::class)->create($rootLine, $site)->getPageTsConfigArray();

        return $pageTsConfig['mod.']['web_layout.']['BackendLayouts.'] ?? [];
    }
}
