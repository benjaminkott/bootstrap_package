<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers\Render;

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextFactory;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class ParentViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('partial', 'string', 'Partial to render');
    }

    /**
     * @return string
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $partial = $arguments['partial'] ?? null;
        if ($partial === null) {
            return '';
        }

        $format = 'html';
        $variables = (array) $renderingContext->getVariableProvider()->getAll();
        $partialRootPaths = $variables['__unprocessedPartialRootPaths'] ?? $renderingContext->getTemplatePaths()->getPartialRootPaths();
        $partialRootPaths = array_filter($partialRootPaths, function ($path) use ($partial, $format) {
            return file_exists($path . $partial . '.' . $format);
        });
        if (count($partialRootPaths) === 1) {
            return '';
        }
        array_pop($partialRootPaths);
        $currentTemplate = end($partialRootPaths) . $partial . '.' . $format;

        if ((new Typo3Version())->getMajorVersion() < 12) {
            $view = GeneralUtility::makeInstance(StandaloneView::class);
        } else {
            $context = GeneralUtility::makeInstance(RenderingContextFactory::class)->create();
            $context->setRequest($renderingContext->getRequest());
            $view = GeneralUtility::makeInstance(StandaloneView::class, $context);
        }
        $view->assignMultiple($variables);
        $view->assign('__unprocessedPartialRootPaths', $partialRootPaths);
        $view->setLayoutRootPaths($renderingContext->getTemplatePaths()->getLayoutRootPaths());
        $view->setPartialRootPaths($renderingContext->getTemplatePaths()->getPartialRootPaths());
        $view->setTemplateRootPaths($renderingContext->getTemplatePaths()->getTemplateRootPaths());
        $view->setTemplatePathAndFilename($currentTemplate);

        return $view->render();
    }
}
