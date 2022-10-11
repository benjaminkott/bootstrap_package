<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers\Link;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Http\ApplicationType;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\HttpUtility;
use TYPO3\CMS\Extbase\Mvc\RequestInterface as ExtbaseRequestInterface;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder as ExtbaseUriBuilder;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContext;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\Typolink\LinkFactory;
use TYPO3\CMS\Frontend\Typolink\UnableToLinkException;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class PaginateViewHelper extends AbstractTagBasedViewHelper
{
    /**
     * @var string
     */
    protected $tagName = 'a';

    /**
     * Initialize arguments
     *
     * @return void
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

        /** @var RenderingContext $renderingContext */
        $renderingContext = $this->renderingContext;
        $request = $renderingContext->getRequest();

        if ($request instanceof ExtbaseRequestInterface) {
            $uriBuilder = GeneralUtility::makeInstance(ExtbaseUriBuilder::class);
            $uriBuilder->reset()
                ->setRequest($request)
                ->setSection($section)
                ->setArguments($arguments);
            return $this->renderLink($uriBuilder->build());
        }

        if ($request instanceof ServerRequestInterface) {
            $applicationType = ApplicationType::fromRequest($request);
            if ($applicationType->isFrontend()) {
                try {
                    $typolinkConfiguration = [];
                    $typolinkConfiguration['parameter'] = 'current';
                    $typolinkConfiguration['additionalParams'] = HttpUtility::buildQueryString($arguments, '&');
                    $typolinkConfiguration['fragment'] = $section;
                    $typolinkConfiguration['addQueryString'] = '1';

                    /** @var ContentObjectRenderer $contentObjectRenderer */
                    $contentObjectRenderer = GeneralUtility::makeInstance(ContentObjectRenderer::class);
                    $contentObjectRenderer->setRequest($request);

                    /** @var LinkFactory $linkFactory */
                    $linkFactory = GeneralUtility::makeInstance(LinkFactory::class);
                    $linkResult = $linkFactory->create('', $typolinkConfiguration, $contentObjectRenderer);
                    return $this->renderLink($linkResult->getUrl());
                } catch (UnableToLinkException $e) {
                    return strval($this->renderChildren());
                }
            }
        }

        throw new \RuntimeException(
            'ViewHelper bk2k:link.paginate needs a request implementing ServerRequestInterface.',
            1639819269
        );
    }

    private function renderLink(string $uri): string
    {
        $content = strval($this->renderChildren());
        if (trim($uri) === '') {
            return $content;
        }

        $this->tag->addAttribute('href', $uri);
        $this->tag->setContent($content);
        $this->tag->forceClosingTag(true);
        return $this->tag->render();
    }
}
