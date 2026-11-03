<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\Service;

use BK2K\BootstrapPackage\Service\ImageInfoService;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Testcase for class \BK2K\BootstrapPackage\Service\ImageInfoService
 */
final class ImageInfoServiceTest extends FunctionalTestCase
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
     * A processed package resource has no original file, so the lookup
     * finds nothing for it rather than a file it cannot answer for.
     */
    #[Test]
    public function processedPackageResourceDoesNotBreakTheLookup(): void
    {
        $imageResource = $this->get(ContentObjectRenderer::class)
            ->getImgResource('EXT:bootstrap_package/Resources/Public/Icons/Extension.png', ['width' => '10']);
        self::assertNotNull($imageResource);

        $processedFile = $this->get(ImageInfoService::class)->findByUri($imageResource->getPublicUrl());

        self::assertTrue($processedFile === null || $processedFile->getOriginalFile()->getExtension() === 'png');
    }
}
