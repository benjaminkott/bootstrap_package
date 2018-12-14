<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContext;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * DataRelationViewHelper
 */
class DataRelationViewHelper extends AbstractViewHelper implements CompilableInterface
{
    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * Render
     *
     * @param int $uid
     * @param string $table
     * @param string $foreignField
     * @param string $selectFields
     * @param string $as
     * @param string $sortby
     * @param string $additionalWhere
     * @return string
     */
    public function render(
        $uid,
        $table,
        $foreignField = 'tt_content',
        $selectFields = '*',
        $as = 'items',
        $sortby = 'sorting ASC',
        $additionalWhere = ''
    ) {
        return self::renderStatic(
            [
                'uid' => $uid,
                'table' => $table,
                'foreignField' => $foreignField,
                'selectFields' => $selectFields,
                'as' => $as,
                'sortby' => $sortby,
                'additionalWhere' => $additionalWhere
            ],
            $this->buildRenderChildrenClosure(),
            $this->renderingContext
        );
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface|RenderingContext $renderingContext
     * @return string
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $templateVariableContainer = $renderingContext->getTemplateVariableContainer();
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
        $templateVariableContainer->add($arguments['as'], $items);
        $content = $renderChildrenClosure();
        $templateVariableContainer->remove($arguments['as']);
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
