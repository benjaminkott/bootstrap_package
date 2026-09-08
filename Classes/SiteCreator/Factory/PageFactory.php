<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\SiteCreator\Factory;

use BK2K\BootstrapPackage\SiteCreator\Dto\Page;

class PageFactory
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): Page
    {
        $page = new Page();

        if (isset($data['id'])) {
            $page->id = $data['id'];
            unset($data['id']);
        }

        if (isset($data['pages'])) {
            foreach ($data['pages'] as $childPageData) {
                $childPage = self::fromArray($childPageData);
                $childPage->parent = $page;
                $page->pages[] = $childPage;
            }
            unset($data['pages']);
        }

        if (isset($data['templates'])) {
            foreach ($data['templates'] as $templateData) {
                $template = TemplateFactory::fromArray($templateData);
                $template->parent = $page;
                $page->templates[] = $template;
            }
            unset($data['templates']);
        }

        if (isset($data['contentBlocks'])) {
            foreach ($data['contentBlocks'] as $contentBlockData) {
                $contentBlock = ContentBlockFactory::fromArray($contentBlockData);
                $contentBlock->parent = $page;
                $page->contentBlocks[] = $contentBlock;
            }
            unset($data['contentBlocks']);
        }

        if (!isset($data['hidden'])) {
            $data['hidden'] = 0;
        }

        $page->parameterBag = $data;

        return $page;
    }
}
