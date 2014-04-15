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
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * @author Benjamin Kott <info@bk2k.info>
 */
class ContextualClassViewHelper extends AbstractViewHelper {

    /**
     * contextualAlternatives
     * 
     * @var array
     */
    protected $contextualAlternatives = array(
        100 => 'default',
        110 => 'primary',
        120 => 'success',
        130 => 'info',
        140 => 'warning',
        150 => 'danger'
    );

    /**
     * @param int $code
     * @return string
     */
    public function render($code = 100) {
        $class = NULL;
        if($this->contextualAlternatives[$code]){
           $class = $this->contextualAlternatives[$code];
        }
        return $class;
    }    

}