<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * InlineSvgViewHelper
 */
class InlineSvgViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * Initialize arguments.
     *
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('image', 'object', 'a FAL object');

        $this->registerArgument('width', 'string', 'Width of the svg.', false);
        $this->registerArgument('height', 'string', 'Height of the svg.', false);
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        /** @var $originalFile \TYPO3\CMS\Core\Resource\File */
        $originalFile = $arguments['image']->getOriginalFile();
        if ($originalFile->getProperty('extension') !== 'svg') {
            return '';
        }

        $svgContent = $originalFile->getContents();
        $svgContent = preg_replace('/<script[\s\S]*?>[\s\S]*?<\/script>/i', '', $svgContent);

        // Disables the functionality to allow external entities to be loaded when parsing the XML, must be kept
        $previousValueOfEntityLoader = libxml_disable_entity_loader(true);
        $svgElement = simplexml_load_string($svgContent);
        libxml_disable_entity_loader($previousValueOfEntityLoader);

        // Override width and height
        if ($arguments['width']) {
            $svgElement->addAttribute('width', (int)$arguments['width']);
        }
        if ($arguments['height']) {
            $svgElement->addAttribute('height', (int)$arguments['height']);
        }

        // remove xml version tag
        $domXml = dom_import_simplexml($svgElement);
        $content = $domXml->ownerDocument->saveXML($domXml->ownerDocument->documentElement);

        return $content;
    }
}
