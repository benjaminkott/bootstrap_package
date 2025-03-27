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
 * Template
 */
class Template extends AbstractEntity
{
    protected string $table = 'sys_template';
    protected ?string $parentStorage = 'templates';
}
