<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers\Data;

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
     * @var array
     */
    protected static $allowedVariantProperties = [
        'breakpoint',
        'width'
    ];

    /**
     * @var array
     */
    protected static $defaultVariants = [
        'default' => [
            'breakpoint' => 1200,
            'width' => 1200
        ]
    ];

    /**
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('as', 'string', 'Name of variable to create', true);
        $this->registerArgument('variants', 'array', 'Variants for responsive images', false);
        $this->registerArgument('multiplier', 'array', 'Multiplier to calculate responsive image widths', false);
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
        $variants = self::$defaultVariants;
        if (is_array($arguments['variants'])) {
            foreach ($arguments['variants'] as $variant => $properties) {
                if (is_array($properties)) {
                    foreach ($properties as $key => $value) {
                        if (in_array($key, self::$allowedVariantProperties) && ((is_numeric($value) && $value > 0) || $value === 'unset')) {
                            $variants[$variant][$key] = (int) $value;
                        }
                    }
                }
            }
        }
        if (is_array($arguments['multiplier'])) {
            foreach ($arguments['multiplier'] as $variant => $multiplier) {
                if (is_numeric($multiplier) && $multiplier > 0 && isset($variants[$variant]['width'])) {
                    $variants[$variant]['width'] = (int) ceil($variants[$variant]['width'] * $multiplier);
                }
            }
        }
        $renderingContext->getVariableProvider()->add($arguments['as'], $variants);
    }
}
