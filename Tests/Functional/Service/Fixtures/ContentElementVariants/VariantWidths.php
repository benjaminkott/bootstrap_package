<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\Service\Fixtures\ContentElementVariants;

use BK2K\BootstrapPackage\DataProcessing\ContainerContextProcessor;
use BK2K\BootstrapPackage\Service\ContentElementVariantsService;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Attribute\AsAllowedCallable;
use TYPO3\CMS\Core\TypoScript\TypoScriptService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Stands in for a plugin asking the service what its box is.
 *
 * A userFunc receives the request carrying currentContentObject, which is
 * the channel an Extbase controller reads the same object from.
 */
final class VariantWidths
{
    #[AsAllowedCallable]
    public function render(string $content, array $conf, ServerRequestInterface $request): string
    {
        $contentObject = $request->getAttribute('currentContentObject');
        if (!$contentObject instanceof ContentObjectRenderer) {
            return '[no content object]';
        }

        $settings = GeneralUtility::makeInstance(TypoScriptService::class)
            ->convertTypoScriptArrayToPlainArray($conf['settings.'] ?? []);

        $service = new ContentElementVariantsService(
            GeneralUtility::makeInstance(ContainerContextProcessor::class)
        );

        $widths = [];
        foreach ($service->getVariants($settings, $contentObject) as $name => $variant) {
            $widths[] = $name . '=' . $variant['width'];
        }

        return '[' . $contentObject->data['uid'] . ':' . implode(',', $widths) . ']';
    }
}
