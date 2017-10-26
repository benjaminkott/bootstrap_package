<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers;

use BK2K\BootstrapPackage\Utility\ExternalMediaUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * ExternalMediaViewHelper
 */
class ExternalMediaViewHelper extends AbstractViewHelper
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
        $this->registerArgument('url', 'string', 'External media url');
        $this->registerArgument('class', 'string', 'CSS class rendered on the generated iframe code');
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
        $variableProvider = $renderingContext->getVariableProvider();
        $externalMediaUtility = GeneralUtility::makeInstance(ExternalMediaUtility::class);
        $externalMedia = $externalMediaUtility->getEmbedCode($arguments['url'], $arguments['class']);
        $variableProvider->add('externalMedia', $externalMedia);
        $content = $renderChildrenClosure();
        $variableProvider->remove('externalMedia');
        return $content;
    }
}
