<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers;

use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

/**
 * LastImageInfoViewHelper
 */
class LastImageInfoViewHelper extends AbstractViewHelper implements CompilableInterface
{
    /**
     * @var array
     */
    protected static $imageInfoMapping = [
        'width' => 0,
        'height' => 1,
        'type' => 2,
        'file' => 3,
        'origFile' => 'origFile',
        'origFile_mtime' => 'origFile_mtime',
        'originalFile' => 'originalFile',
        'processedFile' => 'processedFile',
        'fileCacheHash' => 'fileCacheHash'
    ];

    /**
     * Render
     *
     * @param string $property
     * @return string
     */
    public function render($property = null)
    {
        return self::renderStatic(
            [
                'property' => $property
            ],
            $this->buildRenderChildrenClosure(),
            $this->renderingContext
        );
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return void
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        if ($GLOBALS['TSFE']->lastImageInfo) {
            $property = (array_key_exists($arguments['property'], self::$imageInfoMapping)) ? self::$imageInfoMapping[$arguments['property']] : self::$imageInfoMapping['file'];
            return $GLOBALS['TSFE']->lastImageInfo[$property];
        }
        return null;
    }
}
