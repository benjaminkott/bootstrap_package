<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Utility;

use TYPO3\CMS\Core\Resource\Exception\ResourceDoesNotExistException;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Service\ImageService;

/**
 * SvgUtility
 */
class SvgUtility
{
    /**
     * @param string $src
     * @param FileInterface|null $image
     * @param int|null $height
     * @param int|null $width
     * @param string|null $class
     * @return string
     */
    public static function getInlineSvg(
        string $src = '',
        ?FileInterface $image = null,
        ?int $width = null,
        ?int $height = null,
        ?string $class = null
    ): string {
        if (($src === '' && $image === null) || ($src !== '' && $image !== null)) {
            throw new \Exception('You must either specify a string src or a File object.', 1530601100);
        }

        try {
            $imageService = self::getImageService();
            $image = $imageService->getImage($src, $image, false);
            if ($image->getProperty('extension') !== 'svg') {
                return '';
            }

            $svgContent = $image->getContents();
            $svgContent = trim((string) preg_replace('/<script[\s\S]*?>[\s\S]*?<\/script>/i', '', $svgContent));

            // Exit if file does not contain content
            if ($svgContent === '') {
                return '';
            }

            // Disables the functionality to allow external entities to be loaded when parsing the XML, must be kept
            $previousValueOfEntityLoader = false;
            if (PHP_MAJOR_VERSION < 8) {
                $previousValueOfEntityLoader = libxml_disable_entity_loader(true);
            }
            $svgElement = simplexml_load_string($svgContent);
            if (PHP_MAJOR_VERSION < 8) {
                libxml_disable_entity_loader($previousValueOfEntityLoader);
            }
            if (!$svgElement instanceof \SimpleXMLElement) {
                return '';
            }

            // Override attributes
            $class = filter_var(trim((string) $class), FILTER_SANITIZE_STRING);
            $class = $class !== false ? $class : null;
            $svgElement = self::setAttribute($svgElement, 'class', $class);
            $width = intval($width) > 0 ? (string) intval($width) : null;
            $svgElement = self::setAttribute($svgElement, 'width', $width);
            $height = intval($height) > 0 ? (string) intval($height) : null;
            $svgElement = self::setAttribute($svgElement, 'height', $height);

            // remove xml version tag
            $domXml = dom_import_simplexml($svgElement);
            /** @phpstan-ignore-next-line */
            if (!$domXml instanceof \DOMElement || !$domXml->ownerDocument instanceof \DOMDocument) {
                return '';
            }

            return (string) $domXml->ownerDocument->saveXML($domXml->ownerDocument->documentElement);
        } catch (ResourceDoesNotExistException $e) {
            // thrown if file does not exist
            throw new \Exception($e->getMessage(), 1530601100, $e);
        } catch (\UnexpectedValueException $e) {
            // thrown if a file has been replaced with a folder
            throw new \Exception($e->getMessage(), 1530601101, $e);
        } catch (\RuntimeException $e) {
            // RuntimeException thrown if a file is outside of a storage
            throw new \Exception($e->getMessage(), 1530601102, $e);
        } catch (\InvalidArgumentException $e) {
            // thrown if file storage does not exist
            throw new \Exception($e->getMessage(), 1530601103, $e);
        }
    }

    /**
     * @param \SimpleXMLElement $element
     * @param string $attribute
     * @param string $value
     */
    protected static function setAttribute(\SimpleXMLElement $element, string $attribute, ?string $value): \SimpleXMLElement
    {
        if ($value !== null) {
            if (isset($element->attributes()->$attribute)) {
                $element->attributes()->$attribute = $value;
            } else {
                $element->addAttribute($attribute, $value);
            }
        }

        return $element;
    }

    /**
     * Return an instance of ImageService using object manager
     *
     * @return ImageService
     */
    protected static function getImageService(): ImageService
    {
        return GeneralUtility::makeInstance(ImageService::class);
    }
}
