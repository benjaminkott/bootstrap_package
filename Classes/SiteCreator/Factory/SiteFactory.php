<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\SiteCreator\Factory;

use BK2K\BootstrapPackage\SiteCreator\Dto\Site;

class SiteFactory
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): Site
    {
        $site = new Site();
        $site->title = $data['title'];
        $site->description = $data['description'];
        foreach ($data['pages'] as $page) {
            $site->pages[] = PageFactory::fromArray($page);
        }

        return $site;
    }
}
