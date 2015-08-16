<?php
namespace BK2K\BootstrapPackage\Hooks;

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

/**
 * @author Benjamin Kott <info@bk2k.info>
 */
class DataHandler
{

    /**
     * @param array|mixed $incomingFieldArray
     * @param string $table
     * @param integer $id
     * @param \TYPO3\CMS\Core\DataHandling\DataHandler $pObj
     */
    // @codingStandardsIgnoreStart
    public function processDatamap_preProcessFieldArray(&$incomingFieldArray, $table, $id, $pObj)
    {
        // @codingStandardsIgnoreEnd

        /**
         * Set the correct classes within the flexform according to the layout
         */
        if ($table == 'tt_content' && $incomingFieldArray['CType'] == 'table') {
            $acctables_tableclasses = array();
            $acctables_tableclasses[] = 'table';
            switch ($incomingFieldArray['layout']) {
                case '120':
                    $acctables_tableclasses[] = 'table-striped';
                    break;
                case '130':
                    $acctables_tableclasses[] = 'table-bordered';
                    break;
                case '140':
                    $acctables_tableclasses[] = 'table-hover';
                    break;
                case '150':
                    $acctables_tableclasses[] = 'table-condensed';
                    break;
            }
            $incomingFieldArray['pi_flexform']['data']['sDEF']['lDEF']['acctables_nostyles']['vDEF'] = 1;
            $incomingFieldArray['pi_flexform']['data']['sDEF']['lDEF']['acctables_tableclass']['vDEF'] = implode(
                " ",
                $acctables_tableclasses
            );
        }

        /**
         * Unset height and width for textpic and image to avoid wrong image rendering
         */
        if ($table == 'tt_content' && ($incomingFieldArray['CType'] == 'textpic' || $incomingFieldArray['CType'] == 'image')) {
            $incomingFieldArray['imageheight'] = '';
            $incomingFieldArray['imagewidth'] = '';
        }
    }
}
