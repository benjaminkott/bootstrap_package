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
 * 
 *  Transpose rows into columns 
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

/**
 * @author Benjamin Kott <info@bk2k.info>
 */
class ArrayTransposeViewHelper extends AbstractViewHelper implements CompilableInterface
{
   
    /**
     * Render
     *
     * @param string $data
     * @param string $as
     * @param string $rowas
     * @param integer $cols
     * @param integer $step
     * @return string
     */
    public function render($data, $as = 'items', $rowas = 'rows', $cols = 1, $step = 1)
    {
        return self::renderStatic(
            array(
                'data' => $data,
                'as' => $as,
                'rowas' => $rowas,
                'cols' => $cols,
                'step' => $step
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
        $content = '';
        if (isset($arguments['data'])) {
            $templateVariableContainer = $renderingContext->getTemplateVariableContainer();
            $rows = array_chunk($arguments['data'], $arguments['cols'] * $arguments['step']);
            $nrows = count($rows);
            $cols = array();
            for ($c = 0; $c < $arguments['cols']; $c++) {
                for ($r = 0; $r < $nrows; $r++) {
                    for ($s = 0; $s < $arguments['step']; $s++) {
                         if (isset($rows[$r][$s + $c * $arguments['step']])) {
                             $cols[] = $rows[$r][$s + $c * $arguments['step']];
                         }  
                    }
                }
            }
            if ($templateVariableContainer->exists($arguments['as'])  === true) {
                $templateVariableContainer->remove($arguments['as']);
            }
            if ($templateVariableContainer->exists($arguments['rowas'])  === true) {
                $templateVariableContainer->remove($arguments['rowas']);
            }
            $templateVariableContainer->add($arguments['as'], $cols);
            $templateVariableContainer->add($arguments['rowas'], $nrows);
            $content = $renderChildrenClosure();
            $templateVariableContainer->remove($arguments['as']);
            $templateVariableContainer->remove($arguments['rowas']);         
        }
        return $content;
    }
}
