<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers;

use BK2K\BootstrapPackage\Utility\SvgUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
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
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('image', 'object', 'a FAL object');
        $this->registerArgument('src', 'string', 'a path to a file');
        $this->registerArgument('class', 'string', 'Css class for the svg');
        $this->registerArgument('width', 'string', 'Width of the svg.', false);
        $this->registerArgument('height', 'string', 'Height of the svg.', false);
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     * @throws \Exception
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $src = (string)$arguments['src'];
        $image = $arguments['image'];
        $width = $arguments['width'] ? (int) $arguments['width'] : null;
        $height = $arguments['height'] ? (int) $arguments['height'] : null;
        $class = $arguments['class'] ? (string) $arguments['class'] : null;

        return SvgUtility::getInlineSvg($src, $image, $width, $height, $class);
    }
}
