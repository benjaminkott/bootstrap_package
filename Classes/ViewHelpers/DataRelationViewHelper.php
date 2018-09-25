<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * DataRelationViewHelper
 */
class DataRelationViewHelper extends AbstractViewHelper
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
        $this->registerArgument('uid', 'integer', 'uid', true);
        $this->registerArgument('table', 'string', 'table', true);
        $this->registerArgument('foreignField', 'string', 'foreignField', false, 'tt_content');
        $this->registerArgument('selectFields', 'string', 'selectFields', false, '*');
        $this->registerArgument('as', 'string', 'Name of variable to create', false, 'items');
        $this->registerArgument('sortby', 'string', 'sortby', false, 'sorting');
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return mixed
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $variableProvider = $renderingContext->getVariableProvider();
        if ($arguments['uid'] !== null && $arguments['table'] !== null) {
            $frontendController = self::getFrontendController();

            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($arguments['table']);
            $queryBuilder
                ->select($arguments['selectFields'])
                ->from($arguments['table'])
                ->where(
                    $queryBuilder->expr()->eq(
                        $arguments['foreignField'],
                        $queryBuilder->createNamedParameter($arguments['uid'], \PDO::PARAM_INT)
                    )
                )
                ->addOrderBy($arguments['sortby']);
            $data = $queryBuilder->execute()->fetchAll();
            $items = [];
            foreach ($data as $record) {
                $frontendController->sys_page->versionOL($arguments['table'], $record);
                if (is_array($record)) {
                    $items[] = $frontendController->sys_page->getRecordOverlay(
                        $arguments['table'],
                        $record,
                        $frontendController->sys_language_uid
                    );
                }
            }
            usort(
                $items,
                function ($a, $b) {
                    return $a['sorting'] > $b['sorting'];
                }
            );
        } else {
            $items = null;
        }
        $variableProvider->add($arguments['as'], $items);
        $content = $renderChildrenClosure();
        $variableProvider->remove($arguments['as']);
        return $content;
    }

    /**
     * @return \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
     */
    private static function getFrontendController()
    {
        return $GLOBALS['TSFE'];
    }
}
