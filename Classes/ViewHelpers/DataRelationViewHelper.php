<?php
namespace BK2K\BootstrapPackage\ViewHelpers;

/***************************************************************
 * 
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
 *
 ***************************************************************/
/**
 * @author Benjamin Kott <info@bk2k.info>
 */
class DataRelationViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * @param integer $uid
     * @param string $table
     * @param string $foreignField
     * @param string $selectFields
     * @param string $as
     * @param string $sortby
     * @param string $additionalWhere
     * 
     * @return string
     */
    public function render($uid,$table,$foreignField = "tt_content",$selectFields = "*", $as = "items", $sortby = "sorting ASC", $additionalWhere = "") {

        if($uid && $table && $foreignField){
            $cObj = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectRenderer');
            $selectFields = $selectFields;
            $fromTable    = $table;
            $whereClause  = '1 AND `'.$foreignField.'` = \''.$uid.'\' AND deleted = 0 AND hidden = 0 '.$additionalWhere. $cObj->enableFields($table);
            $groupBy      = '';
            $orderBy      = $sortby;
            $limit        = '';
            $GLOBALS['TYPO3_DB']->store_lastBuiltQuery = 1;
            $data = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows($selectFields, $fromTable, $whereClause, $groupBy, $orderBy, $limit);
            $items = array();
            foreach ($data as $record) {
                $items[] = $GLOBALS['TSFE']->sys_page->getRecordOverlay($table, $record, $GLOBALS['TSFE']->sys_language_uid);
            }
        }else{
            $items = NULL;
        }
        
        $this->templateVariableContainer->add($as, $items);
        $content = $this->renderChildren();
        $this->templateVariableContainer->remove($as); 

        return $content;

    }

}