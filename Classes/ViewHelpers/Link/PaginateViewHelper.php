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
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContext;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\Typolink\LinkFactory;
use TYPO3\CMS\Frontend\Typolink\UnableToLinkException;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class PaginateViewHelper extends AbstractTagBasedViewHelper
{
    /**
     * @var string
     */
    protected $tagName = 'a';

    public function initializeArguments(): void
    {
        parent::initializeArguments();

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

        $renderingContext = $this->renderingContext;
        $request = $this->getRequestFromRenderingContext($renderingContext);
        if ($request !== null) {
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

    protected function renderLink(string $uri): string
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

    protected function getRequestFromRenderingContext(RenderingContextInterface $renderingContext): ?ServerRequestInterface
    {
        if ($renderingContext->hasAttribute(ServerRequestInterface::class)) {
            return $renderingContext->getAttribute(ServerRequestInterface::class);
        } elseif ($renderingContext instanceof RenderingContext) {
            /** @phpstan-ignore-next-line */
            return $renderingContext->getRequest();
        }

        return null;
    }
}
