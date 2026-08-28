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
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\ResourceStorage;
use TYPO3\CMS\Core\Resource\StorageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\TestingFramework\Core\Functional\Framework\Frontend\InternalRequest;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Testcase for the referrer policy handed to the media rendering
 *
 * @see Resources/Private/Partials/ContentElements/Media/Rendering/Video.html
 */
final class MediaTest extends FunctionalTestCase
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

    private ResourceStorage $storage;

    protected function setUp(): void
    {
        parent::setUp();

        $this->importCSVDataSet(__DIR__ . '/Fixtures/Media/pages.csv');
        $this->importCSVDataSet(__DIR__ . '/Fixtures/Media/tt_content.csv');

        $storageRepository = $this->get(StorageRepository::class);
        GeneralUtility::mkdir_deep($this->instancePath . '/fileadmin/');
        $this->storage = $storageRepository->findByUid(
            $storageRepository->createLocalStorage('fixture', 'fileadmin/', 'relative', '', true)
        );

        $onlineMedia = $this->createFile('video.youtube', 'zpOVYePk6mM');
        $this->attachToContentElement($onlineMedia, 1, 11);
        $this->attachToContentElement($this->createFile('video.mp4', self::MP4_HEADER), 2, 12);
        $this->attachToContentElement($onlineMedia, 3, 2);

        $this->writeSite(1, 'http://localhost/');
        $this->writeSite(2, 'http://localhost2/');

        $this->get(CacheManager::class)->flushCaches();

        $this->setUpFrontendRootPage(1, [
            'EXT:bootstrap_package/Tests/Functional/ContentElements/Fixtures/Media/setup.typoscript',
        ]);
        $this->setUpFrontendRootPage(2, [
            'EXT:bootstrap_package/Tests/Functional/ContentElements/Fixtures/Media/setup-without-referrerpolicy.typoscript',
        ]);
    }

    /**
     * Online media renders through an iframe, which is what the referrer policy
     * is defined on.
     */
    #[Test]
    public function onlineMediaCarriesTheConfiguredReferrerPolicy(): void
    {
        $markup = $this->renderPage('http://localhost/index.php?id=11');

        self::assertStringContainsString('<iframe', $markup);
        self::assertStringContainsString('referrerpolicy="strict-origin-when-cross-origin"', $markup);
    }

    /**
     * A local video renders through a video tag, where referrerpolicy is not a
     * defined attribute and would only be invalid markup.
     */
    #[Test]
    public function localVideoCarriesNoReferrerPolicy(): void
    {
        $markup = $this->renderPage('http://localhost/index.php?id=12');

        self::assertStringContainsString('<video', $markup);
        self::assertStringNotContainsString('referrerpolicy', $markup);
    }

    #[Test]
    public function emptyReferrerPolicyRendersNoAttribute(): void
    {
        $markup = $this->renderPage('http://localhost2/index.php?id=2');

        self::assertStringContainsString('<iframe', $markup);
        self::assertStringNotContainsString('referrerpolicy', $markup);
    }

    private function renderPage(string $url): string
    {
        $response = $this->executeFrontendSubRequest(new InternalRequest($url));
        self::assertSame(200, $response->getStatusCode());

        return (string)$response->getBody();
    }

    private function createFile(string $name, string $contents): File
    {
        file_put_contents($this->instancePath . '/fileadmin/' . $name, $contents);
        $file = $this->storage->getFile('/' . $name);
        self::assertInstanceOf(File::class, $file);

        return $file;
    }

    private function attachToContentElement(File $file, int $contentElementId, int $pageId): void
    {
        $this->getConnectionPool()->getConnectionForTable('sys_file_reference')->insert(
            'sys_file_reference',
            [
                'pid' => $pageId,
                'uid_local' => $file->getUid(),
                'uid_foreign' => $contentElementId,
                'tablenames' => 'tt_content',
                'fieldname' => 'assets',
                'sorting_foreign' => 1,
            ]
        );
    }

    private function writeSite(int $rootPageId, string $base): void
    {
        $this->get(SiteWriter::class)->write('bootstrap-package-test-' . $rootPageId, [
            'rootPageId' => $rootPageId,
            'base' => $base,
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

    /**
     * The indexer reads the mime type off the file, and video/mp4 is what picks
     * the video renderer.
     */
    private const MP4_HEADER = "\x00\x00\x00\x20ftypisom\x00\x00\x02\x00isomiso2avc1mp41";
}
