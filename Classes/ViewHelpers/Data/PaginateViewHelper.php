<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers\Data;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Pagination\ArrayPaginator;
use TYPO3\CMS\Core\Pagination\SimplePagination;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContext;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextFactory;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * PaginateViewHelper
 */
class PaginateViewHelper extends AbstractViewHelper
{
    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('id', 'string', 'Identifier of the pagination', true);
        $this->registerArgument('objects', 'mixed', 'Object', true);
        $this->registerArgument('configuration', 'array', 'configuration', false, ['itemsPerPage' => 10, 'insertAbove' => false, 'insertBelow' => true]);
    }

    public function render(): string
    {
        /** @var RenderingContext $renderingContext */
        $renderingContext = $this->renderingContext;

        /** @var ServerRequestInterface|null $request */
        $request = $renderingContext->getRequest();

        /** @phpstan-ignore-next-line */
        if ($request instanceof ServerRequestInterface) {
            $objects = $this->arguments['objects'];
            if (!($objects instanceof QueryResultInterface || is_array($objects))) {
                throw new \UnexpectedValueException('Supplied file object type ' . get_class($objects) . ' must be QueryResultInterface or be an array.', 1623322979);
            }

            $configuration = [
                'itemsPerPage' => 10,
                'insertAbove' => false,
                'insertBelow' => true,
                'section' => ''
            ];
            ArrayUtility::mergeRecursiveWithOverrule($configuration, $this->arguments['configuration'], false);

            $id = $this->arguments['id'];
            $itemsPerPage = (int) $configuration['itemsPerPage'];
            $currentPage = (int) ($request->getQueryParams()['paginate'][$id]['page'] ?? 1);

            if ($objects instanceof QueryResultInterface) {
                $paginator = new QueryResultPaginator($objects, $currentPage, $itemsPerPage);
            } else {
                $paginator = new ArrayPaginator($objects, $currentPage, $itemsPerPage);
            }
            $pagination = new SimplePagination($paginator);

            $paginationView = $this->getTemplateObject($renderingContext);
            $paginationView->assignMultiple([
                'id' => $id,
                'paginator' => $paginator,
                'pagination' => $pagination,
                'configuration' => $configuration
            ]);
            $paginationRendered = $paginationView->render();

            $variableProvider = $renderingContext->getVariableProvider();
            $variableProvider->add('paginator', $paginator);

            $contents = [];
            $contents[] = $configuration['insertAbove'] === true ? $paginationRendered : '';
            $contents[] = $this->renderChildren();
            $contents[] = $configuration['insertBelow'] === true ? $paginationRendered : '';

            $variableProvider->remove('paginator');

            return implode('', $contents);
        }

        throw new \RuntimeException(
            'ViewHelper bk2k:data.paginate needs a request implementing ServerRequestInterface.',
            1639819269
        );
    }

    protected function getTemplateObject(RenderingContext $renderingContext): StandaloneView
    {
        $setup = $this->getConfigurationManager()->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);

        if ((new Typo3Version())->getMajorVersion() < 12) {
            /** @var StandaloneView $view */
            $view = GeneralUtility::makeInstance(StandaloneView::class);
        } else {
            $context = GeneralUtility::makeInstance(RenderingContextFactory::class)->create();
            $context->setRequest($renderingContext->getRequest());
            /** @var StandaloneView $view */
            $view = GeneralUtility::makeInstance(StandaloneView::class, $context);
        }

        $layoutRootPaths = [];
        $layoutRootPaths[] = GeneralUtility::getFileAbsFileName('EXT:bootstrap_package/Resources/Private/Layouts/ViewHelpers/');
        if (isset($setup['plugin.']['tx_bootstrappackage.']['view.']['layoutRootPaths.'])) {
            foreach ($setup['plugin.']['tx_bootstrappackage.']['view.']['layoutRootPaths.'] as $layoutRootPath) {
                $layoutRootPaths[] = GeneralUtility::getFileAbsFileName(rtrim($layoutRootPath, '/') . '/ViewHelpers/');
            }
        }
        $partialRootPaths = [];
        $partialRootPaths[] = GeneralUtility::getFileAbsFileName('EXT:bootstrap_package/Resources/Private/Partials/ViewHelpers/');
        if (isset($setup['plugin.']['tx_bootstrappackage.']['view.']['partialRootPaths.'])) {
            foreach ($setup['plugin.']['tx_bootstrappackage.']['view.']['partialRootPaths.'] as $partialRootPath) {
                $partialRootPaths[] = GeneralUtility::getFileAbsFileName(rtrim($partialRootPath, '/') . '/ViewHelpers/');
            }
        }
        $templateRootPaths = [];
        $templateRootPaths[] = GeneralUtility::getFileAbsFileName('EXT:bootstrap_package/Resources/Private/Templates/ViewHelpers/');
        if (isset($setup['plugin.']['tx_bootstrappackage.']['view.']['templateRootPaths.'])) {
            foreach ($setup['plugin.']['tx_bootstrappackage.']['view.']['templateRootPaths.'] as $templateRootPath) {
                $templateRootPaths[] = GeneralUtility::getFileAbsFileName(rtrim($templateRootPath, '/') . '/ViewHelpers/');
            }
        }

        $view->setLayoutRootPaths($layoutRootPaths);
        $view->setPartialRootPaths($partialRootPaths);
        $view->setTemplateRootPaths($templateRootPaths);
        $view->setTemplate('Paginate/Index');

        return $view;
    }

    protected function getConfigurationManager(): ConfigurationManagerInterface
    {
        /** @var ConfigurationManager $configurationManager  */
        $configurationManager = GeneralUtility::getContainer()->get(ConfigurationManager::class);

        return $configurationManager;
    }
}
