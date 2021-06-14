<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers\Link;

use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class PaginateViewHelper extends AbstractTagBasedViewHelper
{
    /**
     * @var string
     */
    protected $tagName = 'a';

    /**
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerUniversalTagAttributes();

        $this->registerArgument('paginationId', 'string', 'id', true);
        $this->registerArgument('paginationPage', 'int', 'page', true);
    }

    public function render(): string
    {
        $paginationId = (string) $this->arguments['paginationId'];
        $paginationPage = (int) $this->arguments['paginationPage'];
        $section = isset($this->arguments['section']) ? (string)$this->arguments['section'] : '';

        $arguments = [];
        if ($paginationPage > 1) {
            $arguments['paginate'][$paginationId]['page'] = $paginationPage;
        }

        if (method_exists($this->renderingContext, 'getUriBuilder')) {
            /** @var UriBuilder $uriBuilder */
            $uriBuilder = $this->renderingContext->getUriBuilder();
        } elseif (method_exists($this->renderingContext, 'getControllerContext')) {
            /** @var UriBuilder $uriBuilder */
            $uriBuilder = $this->renderingContext->getControllerContext()->getUriBuilder();
        } else {
            return $this->renderChildren();
        }

        $uriBuilder->reset()->setArguments($arguments);

        $uri = $uriBuilder->build();
        if ($uri !== '') {
            $this->tag->addAttribute('href', $uri);
            $this->tag->setContent($this->renderChildren());
            $this->tag->forceClosingTag(true);
            $result = $this->tag->render();
        } else {
            $result = $this->renderChildren();
        }

        return $result;
    }
}
