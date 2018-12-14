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
 * ExternalMediaViewHelper
 */
class ExternalMediaViewHelper extends AbstractViewHelper implements CompilableInterface
{
    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * Render
     *
     * @param string $url
     * @param mixed $class
     * @return string
     */
    public function render($url, $class)
    {
        return self::renderStatic(
            [
                'url' => $url,
                'class' => $class
            ],
            $this->buildRenderChildrenClosure(),
            $this->renderingContext
        );
    }

    /**
     * Checks if the URL is a valid YouTube/Vimeo Link is. If the video id can
     * be extracted the embed code will be returned, else the content of the
     * ViewHelper will be displayed.
     *
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
        $templateVariableContainer = $renderingContext->getTemplateVariableContainer();
        $externalMediaUtility = GeneralUtility::makeInstance('BK2K\\BootstrapPackage\\Utility\\ExternalMediaUtility');
        $externalMedia = $externalMediaUtility->getEmbedCode($arguments['url'], $arguments['class']);
        $templateVariableContainer->add('externalMedia', $externalMedia);
        $content = $renderChildrenClosure();
        $templateVariableContainer->remove('externalMedia');
        return $content;
    }
}
