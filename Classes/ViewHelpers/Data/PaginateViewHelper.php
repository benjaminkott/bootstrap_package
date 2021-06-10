<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers\Data;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Pagination\ArrayPaginator;
use TYPO3\CMS\Core\Pagination\SimplePagination;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * PaginateViewHelper
 */
class PaginateViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('id', 'string', 'Identifier of the pagination', true);
        $this->registerArgument('objects', 'mixed', 'Object', true);
        $this->registerArgument('configuration', 'array', 'configuration', false, ['itemsPerPage' => 10, 'insertAbove' => false, 'insertBelow' => true]);
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     * @throws \Exception
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $objects = $arguments['objects'];
        if (!($objects instanceof QueryResultInterface || is_array($objects))) {
            throw new \UnexpectedValueException('Supplied file object type ' . get_class($objects) . ' must be QueryResultInterface or be an array.', 1623322979);
        }

        $configuration = [
            'itemsPerPage' => 10,
            'insertAbove' => false,
            'insertBelow' => true,
            'section' => ''
        ];
        ArrayUtility::mergeRecursiveWithOverrule($configuration, $arguments['configuration'], false);
        $id = $arguments['id'];
        $itemsPerPage = (int) $configuration['itemsPerPage'];
        $currentPage = (int) (self::getRequest()->getQueryParams()['paginate'][$id]['page'] ?? 1);

        if ($objects instanceof QueryResultInterface) {
            $paginator = new QueryResultPaginator($objects, $currentPage, $itemsPerPage);
        } else {
            $paginator = new ArrayPaginator($objects, $currentPage, $itemsPerPage);
        }
        $pagination = new SimplePagination($paginator);

        $paginationView = self::getPaginationTemplateObject();
        $paginationView->assignMultiple(
            [
                'id' => $id,
                'paginator' => $paginator,
                'pagination' => $pagination,
                'configuration' => $configuration
            ]
        );
        $paginationRendered = $paginationView->render();

        $variableProvider = $renderingContext->getVariableProvider();
        $variableProvider->add('paginator', $paginator);

        $contents = [];
        $contents[] = $configuration['insertAbove'] === true ? $paginationRendered : '';
        $contents[] = $renderChildrenClosure();
        $contents[] = $configuration['insertBelow'] === true ? $paginationRendered : '';

        $variableProvider->remove('paginator');

        return implode('', $contents);
    }

    protected static function getPaginationTemplateObject(): StandaloneView
    {
        /** @var StandaloneView $view */
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setLayoutRootPaths([GeneralUtility::getFileAbsFileName('EXT:bootstrap_package/Resources/Private/Layouts')]);
        $view->setPartialRootPaths([GeneralUtility::getFileAbsFileName('EXT:bootstrap_package/Resources/Private/Partials')]);
        $view->setTemplateRootPaths([GeneralUtility::getFileAbsFileName('EXT:bootstrap_package/Resources/Private/Templates')]);
        $view->setTemplatePathAndFilename(GeneralUtility::getFileAbsFileName('EXT:bootstrap_package/Resources/Private/Templates/ViewHelpers/Paginate/Index.html'));

        return $view;
    }

    protected static function getRequest(): ServerRequestInterface
    {
        return $GLOBALS['TYPO3_REQUEST'];
    }
}
