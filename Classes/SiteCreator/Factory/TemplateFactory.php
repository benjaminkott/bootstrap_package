<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\SiteCreator\Factory;

use BK2K\BootstrapPackage\SiteCreator\Dto\Template;

class TemplateFactory
{
    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): Template
    {
        $template = new Template();
        $template->parameterBag = $data;

        return $template;
    }
}
