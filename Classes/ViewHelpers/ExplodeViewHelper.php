<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

/**
 * ExplodeViewHelper
 */
class ExplodeViewHelper extends AbstractViewHelper implements CompilableInterface
{
    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * Render
     *
     * @param string $data
     * @param string $as
     * @param string $delimiter
     * @return string
     */
    public function render($data, $as = 'items', $delimiter = LF)
    {
        return self::renderStatic(
            [
                'data' => $data,
                'as' => $as,
                'delimiter' => $delimiter
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
        $content = '';
        if (isset($arguments['data'])) {
            $templateVariableContainer = $renderingContext->getTemplateVariableContainer();
            $items = GeneralUtility::trimExplode($arguments['delimiter'], $arguments['data']);
            $templateVariableContainer->add($arguments['as'], $items);
            $content = $renderChildrenClosure();
            $templateVariableContainer->remove($arguments['as']);
        }
        return $content;
    }
}
