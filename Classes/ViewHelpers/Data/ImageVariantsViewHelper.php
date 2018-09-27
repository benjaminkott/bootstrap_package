<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers\Data;

use BK2K\BootstrapPackage\Utility\ImageVariantsUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * ImageVariantsViewHelper
 */
class ImageVariantsViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('as', 'string', 'Name of variable to create', true);
        $this->registerArgument('variants', 'array', 'Variants for responsive images', false);
        $this->registerArgument('multiplier', 'array', 'Multiplier to calculate responsive image widths', false);
        $this->registerArgument('gutters', 'array', 'Gutter that needs to be respected when calculating responsive image widths', false);
        $this->registerArgument('corrections', 'array', 'Corrections to be applied after calculationof image widths', false);
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return mixed
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $variants = ImageVariantsUtility::getImageVariants($arguments['variants'], $arguments['multiplier'], $arguments['gutters'], $arguments['corrections']);
        $renderingContext->getVariableProvider()->add($arguments['as'], $variants);
    }
}
