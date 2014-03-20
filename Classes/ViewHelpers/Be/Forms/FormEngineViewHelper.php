<?php
namespace BK2K\BootstrapPackage\ViewHelpers\Be\Forms;

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

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * @author Benjamin Kott <info@bk2k.info>
 */
class FormEngineViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * @var \TYPO3\CMS\Core\Page\PageRenderer
     */
    protected $pageRenderer;

    /**
     * @var \TYPO3\CMS\Backend\Form\FormEngine
     */
    protected $tceforms;

    /**
     * @param \TYPO3\CMS\Core\Page\PageRenderer $pageRenderer
     */
    public function injectPageRenderer(\TYPO3\CMS\Core\Page\PageRenderer $pageRenderer) {
        $this->pageRenderer = $pageRenderer;
    }
    
    /**
     * @return fieldnameprefix for form
     */
    protected function getFieldNamePrefix() {
        $fieldNamePrefix = (string) $this->viewHelperVariableContainer->get('TYPO3\\CMS\\Fluid\\ViewHelpers\\FormViewHelper', 'fieldNamePrefix');
        return $fieldNamePrefix;
    }

    /**
     * @param string $table
     * @param array|string $data
     * @return string
     */
    public function render($table = NULL, $data = NULL) {
        
        if(!$data){
            $data = array();
        }
                
        if($table){
            if(!$data['uid']){
                $data['uid'] = "none";
            }
            if(!$data['pid']){
                $data['pid'] = "0";
            }

            $this->pageRenderer->loadPrototype();
            $this->pageRenderer->loadExtJS();

            $this->tceforms = GeneralUtility::makeInstance('TYPO3\CMS\Backend\Form\FormEngine');
            $this->tceforms->initDefaultBEMode();
            
            // EXTBASE FORMS 
            $this->tceforms->prependFormFieldNames = $this->getFieldNamePrefix();
            $this->tceforms->formName = $table;
            $this->tceforms->totalWrap = '<div class="typo3-TCEforms"> |  </div>';
            
            $this->tceforms->doSaveFieldName = 'doSave';
            $this->tceforms->localizationMode = GeneralUtility::inList('text,media',$this->localizationMode) ? $this->localizationMode : '';
            $this->tceforms->returnUrl = $this->R_URI;
            $this->tceforms->palettesCollapsed = !$this->MOD_SETTINGS['showPalettes'];
            $this->tceforms->disableRTE = !$GLOBALS['BE_USER']->isRTE();
            $this->tceforms->enableClickMenu = TRUE;
            $this->tceforms->enableTabMenu = TRUE;
                        
            $panel = $this->tceforms->getMainFields($table,$data);
            $body.= $this->tceforms->printNeededJSFunctions_top();
            $body.= $this->tceforms->wrapTotal($panel,$data,$table);
            $body.= $this->tceforms->printNeededJSFunctions();
            if (count($this->tceforms->commentMessages))	{
                $body.= '
                    <!-- TCEFORM messages
                    '.htmlspecialchars(implode(LF,$this->tceforms->commentMessages)).'
                    -->
                ';
            }
            
        }else{
            return "Tabelle wurde nicht angegeben.";
        }
                
        return $body;
    }

}