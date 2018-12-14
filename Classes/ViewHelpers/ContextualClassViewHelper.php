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
 * ContextualClassViewHelper
 */
class ContextualClassViewHelper extends AbstractViewHelper implements CompilableInterface
{

    /**
     * @var array
     */
    protected static $contextualAlternatives = [
        100 => 'default',
        110 => 'primary',
        120 => 'success',
        130 => 'info',
        140 => 'warning',
        150 => 'danger'
    ];

    /**
     * Render
     *
     * @param int $code
     * @return string
     */
    public function render($code)
    {
        return self::renderStatic(
            [
                'code' => $code
            ],
            $this->buildRenderChildrenClosure(),
            $this->renderingContext
        );
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
        return (self::$contextualAlternatives[$arguments['code']]) ? self::$contextualAlternatives[$arguments['code']] : null;
    }
}
