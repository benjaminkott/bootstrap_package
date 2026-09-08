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
 * Site
 */
class Site
{
    public string $title;
    public string $description;
    public array $pages = [];

    public function toDataHandler(): array
    {
        $data = [];
        foreach ($this->pages as $page) {
            $data = array_merge_recursive($data, $page->toDataHandler());
        }

        return $data;
    }
}
