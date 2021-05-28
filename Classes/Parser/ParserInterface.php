<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Parser;

/**
 * ParserInterface
 */
interface ParserInterface
{
    /**
     * @param string $extension
     * @return bool
     */
    public function supports(string $extension): bool;

    /**
     * @param string $file
     * @param array $settings
     * @return string
     */
    public function compile(string $file, array $settings): string;
}
