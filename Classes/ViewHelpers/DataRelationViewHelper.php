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
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
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
        $this->registerArgument('sortby', 'string', 'sortby', false, 'sorting ASC');
        $this->registerArgument('additionalWhere', 'string', 'additionalWhere', false, '');
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return void
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $variableProvider = $renderingContext->getVariableProvider();
        if ($arguments['uid'] !== null && $arguments['table'] !== null) {
            $connection = static::getDatabaseConnection();
            $frontendController = static::getFrontendController();
            $contentObjectRenderer = static::createContentObjectRenderer();
            $whereClause = $arguments['foreignField'] . '=' . (int)$arguments['uid']
                . ' ' . $arguments['additionalWhere']
                . $contentObjectRenderer->enableFields($arguments['table']);
            $groupBy = '';
            $limit = '';
            $connection->store_lastBuiltQuery = 1;
            $data = $connection->exec_SELECTgetRows(
                $arguments['selectFields'],
                $arguments['table'],
                $whereClause,
                $groupBy,
                $arguments['sortby'],
                $limit
            );
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
     * @return ContentObjectRenderer
     */
    private static function createContentObjectRenderer()
    {
        return GeneralUtility::makeInstance(
            ContentObjectRenderer::class
        );
    }

    /**
     * @return \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
     */
    private static function getFrontendController()
    {
        return $GLOBALS['TSFE'];
    }

    /**
     * @return \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    private static function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }
}
