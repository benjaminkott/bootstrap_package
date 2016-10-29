<?php
namespace BK2K\BootstrapPackage\ViewHelpers;

/*
 *  The MIT License (MIT)
 *
 *  Copyright (c) 2016 Stephen Leger, http://www.3dservices.ch
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
 * @author Stephen Leger <stephen@3dservices.ch>
 */

use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

class SimpleMathViewHelper extends AbstractViewHelper implements CompilableInterface
{
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('operator', 'string', 'Operator + - / * % & | ', true);
        $this->registerArgument('a', 'float', 'Value a', true);
        $this->registerArgument('b', 'float', 'Value b', true);
        $this->registerArgument('round', 'boolean', 'round result', false, false);
        $this->registerArgument('ceil', 'boolean', 'ceil result', false, false);
        $this->registerArgument('floor', 'boolean', 'floor result', false, false);
    }
    /*
    * render
    * @return string
    */
    public function render()
    {
        return self::renderStatic(
            $this->arguments,
            $this->buildRenderChildrenClosure(),
            $this->renderingContext
        );
    }
    /**
    * @param array $arguments
    * @param \Closure $renderChildrenClosure
    * @param RenderingContextInterface $renderingContext
    * @return float
    */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $content = 0;
        $a = floatval($arguments['a']);
        $b = floatval($arguments['b']);
        switch ($arguments['operator']) {
            case '&': // binary and
                $content = ($a & $b);
                break;
            case '|': // binary or
                $content = ($a | $b);
                break;
            case '+':
                $content = ($a + $b);
                break;
            case '-':
                $content = ($a - $b);
                break;
            case '*':
                $content = ($a * $b);
                break;
            case '/':
                if ($b > 0) {
                    $content = ($a / $b);
                }
                break;
            case '%':
                if ($b > 0) {
                    $content = ($a % $b);
                }
                break;
            case 'min':
                $content = min($a, $b);
                break;
            case 'max':
                $content = max($a, $b);
                break;
        }
        if ($arguments['round']) {
            $content = round($content);
        }
        if ($arguments['floor']) {
            $content = floor($content);
        }
        if ($arguments['ceil']) {
            $content = ceil($content);
        }
        return $content;
    }
}
