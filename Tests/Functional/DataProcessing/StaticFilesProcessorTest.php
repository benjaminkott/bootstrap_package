<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\DataProcessing;

use BK2K\BootstrapPackage\Tests\Functional\FixtureStorageTrait;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Configuration\SiteWriter;
use TYPO3\TestingFramework\Core\Functional\Framework\Frontend\InternalRequest;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Testcase for the static files processor, which resolves the logo
 *
 * @see Configuration/Sets/Full/TypoScript/General/page.typoscript
 */
final class StaticFilesProcessorTest extends FunctionalTestCase
{
    use FixtureStorageTrait;

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

        $this->importCSVDataSet(__DIR__ . '/Fixtures/StaticFiles/pages.csv');

        $this->createFixtureStorage();
        copy(
            __DIR__ . '/../../../Resources/Public/Images/BootstrapPackage.svg',
            $this->instancePath . '/fileadmin/logo.svg'
        );

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
            'EXT:bootstrap_package/Tests/Functional/DataProcessing/Fixtures/StaticFiles/setup.typoscript',
        ]);
    }

    #[Test]
    public function filesOfExtensionsAndFileStoragesAreRendered(): void
    {
        $response = $this->executeFrontendSubRequest(new InternalRequest('http://localhost/'));
        self::assertSame(200, $response->getStatusCode());
        $body = trim((string)$response->getBody());

        self::assertMatchesRegularExpression('#\[extension:[^\]]*/BootstrapPackage\.svg[^\]]*\]#', $body);
        self::assertMatchesRegularExpression('#\[storage:/?fileadmin/logo\.svg[^\]]*\]#', $body);
        self::assertStringNotContainsString('[missing:', $body);
    }
}
