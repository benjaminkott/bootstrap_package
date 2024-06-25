<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\SiteCreator\Factory;

use BK2K\BootstrapPackage\SiteCreator\Dto\ContentBlock;

class ContentBlockFactory
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): ContentBlock
    {
        $contentBlock = new ContentBlock();
        if (isset($data['id'])) {
            $contentBlock->id = $data['id'];
            unset($data['id']);
        }
        $contentBlock->parameterBag = $data;

        return $contentBlock;
    }
}
