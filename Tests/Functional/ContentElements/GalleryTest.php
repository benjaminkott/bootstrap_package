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
 * Testcase for the paginated gallery content element
 *
 * @see Resources/Private/Templates/ContentElements/Gallery.html
 */
final class GalleryTest extends FunctionalTestCase
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

    private ResourceStorage $storage;

    protected function setUp(): void
    {
        parent::setUp();

        $this->importCSVDataSet(__DIR__ . '/Fixtures/Gallery/pages.csv');
        $this->importCSVDataSet(__DIR__ . '/Fixtures/Gallery/tt_content.csv');

        $storageRepository = $this->get(StorageRepository::class);
        GeneralUtility::mkdir_deep($this->instancePath . '/fileadmin/');
        $this->storage = $storageRepository->findByUid(
            $storageRepository->createLocalStorage('fixture', 'fileadmin/', 'relative', '', true)
        );

        foreach (range(1, 4) as $number) {
            $this->attachToContentElement($this->createFile('gallery-image-' . $number . '.png'), 1, $number);
        }

        $this->get(SiteWriter::class)->write('bootstrap-package-gallery', [
            'rootPageId' => 1,
            'base' => self::BASE,
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
            'EXT:bootstrap_package/Tests/Functional/ContentElements/Fixtures/Gallery/setup.typoscript',
        ]);
    }

    #[Test]
    public function theGalleryShowsAsManyImagesAsItemsPerPageAllows(): void
    {
        $markup = $this->renderPage('/');

        self::assertStringContainsString('gallery-image-1', $markup);
        self::assertStringContainsString('gallery-image-2', $markup);
        self::assertStringNotContainsString('gallery-image-3', $markup);
    }

    /**
     * The gallery hands its uid to the pagination as an identifier and as the
     * anchor of its own content element, so paging leads to the next images
     * instead of to the top of the page.
     */
    #[Test]
    public function pagingTheGalleryLeadsToTheRemainingImages(): void
    {
        $link = $this->pageLink($this->renderPage('/'), '2');
        self::assertStringEndsWith('#c1', $link);
        self::assertStringContainsString('paginate[id]=gallery-1', urldecode($link));

        $markup = $this->renderPage($link);

        self::assertStringContainsString('gallery-image-3', $markup);
        self::assertStringContainsString('gallery-image-4', $markup);
        self::assertStringNotContainsString('gallery-image-1', $markup);
    }

    private function renderPage(string $url): string
    {
        $response = $this->executeFrontendSubRequest(new InternalRequest(self::BASE . ltrim($url, '/')));
        self::assertSame(200, $response->getStatusCode());

        return (string)$response->getBody();
    }

    /**
     * Target of the link labelled with the given page number.
     */
    private function pageLink(string $markup, string $label): string
    {
        $pattern = '~<a\b[^>]*href="([^"]*)"[^>]*>\s*<span class="page-link-title">' . preg_quote($label, '~') . '</span>~';
        self::assertSame(1, preg_match($pattern, $markup, $matches), 'The gallery has no link to page ' . $label . '.');

        return html_entity_decode($matches[1]);
    }

    private function createFile(string $name): File
    {
        file_put_contents($this->instancePath . '/fileadmin/' . $name, (string)base64_decode(self::PNG_PIXEL, true));
        $file = $this->storage->getFile('/' . $name);
        self::assertInstanceOf(File::class, $file);

        return $file;
    }

    private function attachToContentElement(File $file, int $contentElementId, int $sorting): void
    {
        $this->getConnectionPool()->getConnectionForTable('sys_file_reference')->insert(
            'sys_file_reference',
            [
                'pid' => 1,
                'uid_local' => $file->getUid(),
                'uid_foreign' => $contentElementId,
                'tablenames' => 'tt_content',
                'fieldname' => 'image',
                'sorting_foreign' => $sorting,
            ]
        );
    }

    /**
     * The gallery filters its files by extension, and the image only has to be
     * readable enough for the indexer to take its dimensions off it.
     */
    private const PNG_PIXEL = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg==';
}
