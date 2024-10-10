<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers;

use BK2K\BootstrapPackage\Utility\ExternalMediaUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * ExternalMediaViewHelper
 */
class ExternalMediaViewHelper extends AbstractViewHelper
{
    /**
     * @var bool
     */
    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('title', 'string', 'External media iframe title');
        $this->registerArgument('url', 'string', 'External media url');
        $this->registerArgument('class', 'string', 'CSS class rendered on the generated iframe code');
    }

    /**
     * Checks if the URL is a valid YouTube/Vimeo Link is. If the video id can
     * be extracted the embed code will be returned, else the content of the
     * ViewHelper will be displayed.
     *
     * @return string
     */
    public function render()
    {
        $variableProvider = $this->renderingContext->getVariableProvider();
        $externalMediaUtility = GeneralUtility::makeInstance(ExternalMediaUtility::class);
        $externalMedia = $externalMediaUtility->getEmbedCode($this->arguments['url'], $this->arguments['class'], $this->arguments['title']);
        $variableProvider->add('externalMedia', $externalMedia);
        $content = $this->renderChildren();
        $variableProvider->remove('externalMedia');
        return $content;
    }
}
