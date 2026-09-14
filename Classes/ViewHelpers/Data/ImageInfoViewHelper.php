<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers\Data;

use BK2K\BootstrapPackage\Service\ImageInfoService;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * ImageInfoViewHelper
 */
class ImageInfoViewHelper extends AbstractViewHelper
{
    private const SUPPORTED_PROPERTIES = ['width', 'height', 'type', 'origFile', 'origFile_mtime'];

    public function __construct(
        private readonly ImageInfoService $imageInfoService,
    ) {
    }

    public function initializeArguments(): void
    {
        $this->registerArgument('src', 'string', 'Path to a file');
        $this->registerArgument('property', 'string', 'Possible values: width, height, type, origFile, origFile_mtime');
    }

    /**
     * @return string
     */
    public function render()
    {
        $src = $this->arguments['src'];
        $property = $this->arguments['property'];

        if (!in_array($property, self::SUPPORTED_PROPERTIES, true)) {
            throw new \InvalidArgumentException('The value of property is invalid. Valid properties are: width, height, type, origFile or origFile_mtime');
        }

        $processedFile = $this->imageInfoService->findByUri((string) $src);
        if ($processedFile === null) {
            return '';
        }

        return match ($property) {
            'width', 'height' => (string) $processedFile->getProperty($property),
            'type' => $processedFile->getExtension(),
            'origFile' => (string) $processedFile->getPublicUrl(),
            'origFile_mtime' => (string) $processedFile->getOriginalFile()->getModificationTime(),
        };
    }
}
