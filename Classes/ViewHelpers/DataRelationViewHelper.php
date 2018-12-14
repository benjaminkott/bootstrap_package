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
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

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
     * @param RenderingContextInterface $renderingContext
     * @return string
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $templateVariableContainer = $renderingContext->getTemplateVariableContainer();
        if ($arguments['uid'] !== null && $arguments['table'] !== null) {
            $cObj = GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectRenderer');
            $whereClause = '1 AND `' . $arguments['foreignField'] . '` = \'' . $arguments['uid'] . '\' ' . $arguments['additionalWhere'] . $cObj->enableFields($arguments['table']);
            $groupBy = '';
            $limit = '';
            $GLOBALS['TYPO3_DB']->store_lastBuiltQuery = 1;
            $data = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
                $arguments['selectFields'],
                $arguments['table'],
                $whereClause,
                $groupBy,
                $arguments['sortby'],
                $limit
            );
            $items = [];
            foreach ($data as $record) {
                $GLOBALS['TSFE']->sys_page->versionOL($arguments['table'], $record);
                if (is_array($record)) {
                    $items[] = $GLOBALS['TSFE']->sys_page->getRecordOverlay(
                        $arguments['table'],
                        $record,
                        $GLOBALS['TSFE']->sys_language_uid
                    );
                }
            }
            usort($items, [self, 'orderBySorting']);
        } else {
            $items = null;
        }
        $templateVariableContainer->add($arguments['as'], $items);
        $content = $renderChildrenClosure();
        $templateVariableContainer->remove($arguments['as']);
        return $content;
    }

    /**
     * @param array $a
     * @param array $b
     * @return string
     */
    public static function orderBySorting($a, $b)
    {
        return $a['sorting'] > $b['sorting'];
    }
}
