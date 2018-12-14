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
 * VarViewHelper
 */
class VarViewHelper extends AbstractViewHelper implements CompilableInterface
{

    /**
     * Render
     *
     * @param string $name
     * @param mixed $value
     * @return string
     */
    public function render($name = null, $value = null)
    {
        return self::renderStatic(
            [
                'name' => $name,
                'value' => $value
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
        if ($arguments['name'] !== null) {
            $templateVariableContainer = $renderingContext->getTemplateVariableContainer();
            if ($arguments['value'] === null) {
                $value = $renderChildrenClosure();
            } else {
                $value = (is_string($arguments['value']) ? trim($arguments['value']) : $arguments['value']);
            }
            if ($templateVariableContainer->exists($arguments['name']) === true) {
                $templateVariableContainer->remove($arguments['name']);
            }
            $templateVariableContainer->add($arguments['name'], $value);
        }
        return null;
    }
}
