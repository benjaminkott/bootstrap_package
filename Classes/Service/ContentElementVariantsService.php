<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Service;

use BK2K\BootstrapPackage\DataProcessing\ContainerContextProcessor;
use BK2K\BootstrapPackage\Utility\ImageVariantsUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Image variants for the box a content element renders in.
 *
 * Layouts/ContentElements/Default.html does this in Fluid, which serves
 * every element rendered through a template of this package. An Extbase
 * plugin is rendered through Generic.html, which hands off to
 * tt_content.<CType>.20 via f:cObject — a rendering context that receives
 * data and table and nothing else, so the variants the layout calculated
 * do not reach it. Such a plugin asks here instead.
 */
final readonly class ContentElementVariantsService
{
    public function __construct(
        private ContainerContextProcessor $containerContextProcessor
    ) {
    }

    /**
     * @param array $settings lib.contentElement.settings.responsiveimages
     */
    public function getVariants(array $settings, ContentObjectRenderer $contentObject): array
    {
        $variants = ImageVariantsUtility::getImageVariants($settings['variants'] ?? null);
        $variants = $this->applyBackendLayout($variants, $settings, $contentObject);

        return $this->applyContainerContext($variants, $settings, $contentObject);
    }

    /**
     * Narrow variants by one configuration block, for the steps an element
     * applies on top of its box — a grid column count, an image position.
     */
    public function narrow(array $variants, ?array $configuration): array
    {
        if ($configuration === null) {
            return $variants;
        }

        return ImageVariantsUtility::getImageVariants(
            $variants,
            $configuration['multiplier'] ?? null,
            $configuration['gutters'] ?? null,
            $configuration['corrections'] ?? null
        );
    }

    private function applyBackendLayout(array $variants, array $settings, ContentObjectRenderer $contentObject): array
    {
        $backendLayout = str_replace('pagets__', '', $contentObject->getData('pagelayout'));
        if ($backendLayout === '') {
            // What the backendlayout TypoScript object does with ifEmpty.
            $backendLayout = 'default';
        }
        $colPos = (string)($contentObject->data['colPos'] ?? 0);

        return $this->narrow($variants, $settings['backendlayout'][$backendLayout][$colPos] ?? null);
    }

    private function applyContainerContext(array $variants, array $settings, ContentObjectRenderer $contentObject): array
    {
        $data = $contentObject->data;
        if ((int)($data['tx_container_parent'] ?? 0) === 0) {
            return $variants;
        }

        $containerContext = array_reverse(
            $this->containerContextProcessor->getContainerContext(
                $this->containerContextProcessor->getPageRecords($contentObject, (int)($data['pid'] ?? 0)),
                $data
            )
        );

        foreach ($containerContext as $container) {
            // childColPos, not colPos: each level is narrowed by the column
            // the next level sits in.
            $column = (string)$container['childColPos'];
            $variants = $this->narrow($variants, $settings['container'][$container['CType']][$column] ?? null);
        }

        return $variants;
    }
}
