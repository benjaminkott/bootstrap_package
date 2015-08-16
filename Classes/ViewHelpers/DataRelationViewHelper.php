<?php
namespace BK2K\BootstrapPackage\ViewHelpers;

/*
 *  The MIT License (MIT)
 *
 *  Copyright (c) 2014 Benjamin Kott, http://www.bk2k.info
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in
 *  all copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *  THE SOFTWARE.
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;

/**
 * @author Benjamin Kott <info@bk2k.info>
 */
class DataRelationViewHelper extends AbstractViewHelper implements CompilableInterface
{

    /**
     * Render
     *
     * @param integer $uid
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
            array(
                'uid' => $uid,
                'table' => $table,
                'foreignField' => $foreignField,
                'selectFields' => $selectFields,
                'as' => $as,
                'sortby' => $sortby,
                'additionalWhere' => $additionalWhere
            ),
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
            $items = array();
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
            usort($items, array(self, "orderBySorting"));
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
