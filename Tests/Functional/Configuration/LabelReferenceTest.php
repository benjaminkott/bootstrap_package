<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\Configuration;

use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Localization\LanguageServiceFactory;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Testcase for the label references of the configuration
 */
final class LabelReferenceTest extends FunctionalTestCase
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

    /**
     * A label file the core drops leaves the forms with empty labels, so
     * every reference has to resolve on each declared TYPO3 major.
     */
    #[Test]
    public function everyLabelReferenceResolves(): void
    {
        $languageService = $this->get(LanguageServiceFactory::class)->create('default');
        $configuration = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(__DIR__ . '/../../../Configuration', \FilesystemIterator::SKIP_DOTS)
        );

        $unresolved = [];
        foreach ($configuration as $file) {
            preg_match_all('~LLL:EXT:[^;,\'"<\s]+~', (string)file_get_contents($file->getPathname()), $matches);
            foreach ($matches[0] as $reference) {
                if ($languageService->sL($reference) === '') {
                    $unresolved[] = $reference;
                }
            }
        }

        self::assertSame([], array_values(array_unique($unresolved)));
    }
}
