<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Icons;

use BK2K\BootstrapPackage\Utility\SvgUtility;
use TYPO3\CMS\Core\Resource\Exception\ResourceDoesNotExistException;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Service\ImageService;

/**
 * FileIcon
 */
class FileIcon extends AbstractIcon
{
    /**
     * @var FileInterface
     */
    protected $file;

    /**
     * @param FileInterface $file
     * @return self
     */
    public function setFile(FileInterface $file): self
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return FileInterface
     */
    public function getFile(): FileInterface
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        try {
            $imageService = GeneralUtility::makeInstance(ImageService::class);
            $image = $imageService->getImage('', $this->file, false);
            $height = $this->getHeight();
            $width = $this->getWidth();

            if ($image->getExtension() === 'svg') {
                return SvgUtility::getInlineSvg('', $image, $width, $height);
            }

            $processingInstructions = [
                'width' => $width . 'c',
                'height' => $height . 'c'
            ];
            $processedImage = $imageService->applyProcessingInstructions($image, $processingInstructions);
            $imageUri = $imageService->getImageUri($processedImage);

            return '<img loading="lazy" src="' . $imageUri . '" height="' . $height . '" width="' . $width . '" />';
        } catch (ResourceDoesNotExistException $e) {
            // thrown if file does not exist
            throw new \Exception($e->getMessage(), 1628773040, $e);
        } catch (\UnexpectedValueException $e) {
            // thrown if a file has been replaced with a folder
            throw new \Exception($e->getMessage(), 1628773041, $e);
        } catch (\RuntimeException $e) {
            // RuntimeException thrown if a file is outside of a storage
            throw new \Exception($e->getMessage(), 1628773042, $e);
        } catch (\InvalidArgumentException $e) {
            // thrown if file storage does not exist
            throw new \Exception($e->getMessage(), 1628773043, $e);
        }
    }
}
