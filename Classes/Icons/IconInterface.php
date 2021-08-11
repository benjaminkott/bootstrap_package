<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Icons;

/**
 * IconInterface
 */
interface IconInterface
{
    /**
     * @param string $identifier
     * @return self
     */
    public function setIdentifier(string $identifier);

    /**
     * @return string
     */
    public function getIdentifier(): string;

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $previewImage
     * @return self
     */
    public function setPreviewImage(string $previewImage);

    /**
     * @return string
     */
    public function getPreviewImage(): string;

    /**
     * @param int $width
     * @return self
     */
    public function setWidth(int $width);

    /**
     * @return int
     */
    public function getWidth(): int;

    /**
     * @param int $height
     * @return self
     */
    public function setHeight(int $height);

    /**
     * @return int
     */
    public function getHeight(): int;

    /**
     * @return string
     */
    public function render(): string;
}
