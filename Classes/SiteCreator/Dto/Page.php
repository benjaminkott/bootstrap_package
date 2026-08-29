<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\SiteCreator\Dto;

/**
 * Page
 */
class Page extends AbstractEntity
{
    protected string $table = 'pages';
    protected ?string $parentStorage = 'pages';

    public array $pages = [];
    public array $templates = [];
    public array $contentBlocks = [];

    public function toDataHandler(): array
    {
        $data = parent::toDataHandler();

        foreach ($this->pages as $childPage) {
            $data = array_merge_recursive($data, $childPage->toDataHandler());
        }
        foreach ($this->templates as $template) {
            $data = array_merge_recursive($data, $template->toDataHandler());
        }
        foreach ($this->contentBlocks as $contentBlock) {
            $data = array_merge_recursive($data, $contentBlock->toDataHandler());
        }

        return $data;
    }
}
