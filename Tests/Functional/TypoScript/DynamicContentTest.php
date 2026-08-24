<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\TypoScript;

use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Configuration\SiteWriter;
use TYPO3\TestingFramework\Core\Functional\Framework\Frontend\InternalRequest;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Testcase for lib.dynamicContent
 *
 * @see Configuration/Sets/ContentElements/TypoScript/Helper/DynamicContent.typoscript
 */
final class DynamicContentTest extends FunctionalTestCase
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

        $this->importCSVDataSet(__DIR__ . '/Fixtures/DynamicContent/pages.csv');
        $this->importCSVDataSet(__DIR__ . '/Fixtures/DynamicContent/tt_content.csv');

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
            'EXT:bootstrap_package/Tests/Functional/TypoScript/Fixtures/DynamicContent/setup.typoscript',
        ]);
    }

    #[Test]
    public function contentOfTheCurrentPageIsRendered(): void
    {
        self::assertSame(
            '[Content of source page]',
            $this->renderFrontendPage(2)
        );
    }

    /**
     * Page 3 carries content_from_pid = 2, so its own elements must not show up.
     *
     * The pid the content is read from is derived from the pageUid register
     * within the same LOAD_REGISTER that sets it, which stopped working when
     * LOAD_REGISTER became transactional in TYPO3 v14.
     */
    #[Test]
    public function contentIsReadFromTheContentSourcePageOfTheCurrentPage(): void
    {
        self::assertSame(
            '[Content of source page]',
            $this->renderFrontendPage(3)
        );
    }

    /**
     * Same as above, but with the pageUid handed over through the data array,
     * which is how the helper is documented to be used. Page 1 is requested, so
     * a contentFromPid resolved from the current page instead of from the
     * handed over pageUid would go unnoticed.
     */
    #[Test]
    public function contentIsReadFromTheContentSourcePageOfTheGivenPage(): void
    {
        self::assertSame(
            '[Content of source page]',
            $this->renderFrontendPage(1, 1)
        );
    }

    private function renderFrontendPage(int $pageId, int $type = 0): string
    {
        $response = $this->executeFrontendSubRequest(
            new InternalRequest('http://localhost/index.php?id=' . $pageId . '&type=' . $type)
        );
        self::assertSame(200, $response->getStatusCode());

        return trim((string)$response->getBody());
    }
}
