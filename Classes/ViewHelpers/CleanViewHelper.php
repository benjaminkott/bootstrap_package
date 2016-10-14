<?php
namespace BK2K\BootstrapPackage\ViewHelpers;

/*
*  The MIT License (MIT)
*
*  Copyright (c) 2016 Stephen Leger
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

use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

/**
* @author Stephen Leger
*/

class CleanViewHelper extends AbstractViewHelper implements CompilableInterface
{
    /**
    * Tab character
    *
    * @var string
    */
    protected static $tab = "\t";

    /**
    * Newline character
    *
    * @var string
    */
    protected static $newline = "\n";

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
    * Clean up multiple white space
    *
    * @param string $html
    *
    * @return string
    */
    protected static function optimize($html)
    {
        // newlines
        $html = preg_replace("(\r\n|\n|\r)", self::$newline, $html);
        // remove empty lines
        $html = preg_replace("/(^[" . self::$newline . "]*|[". self::$newline ."]+)[\s\t]*[" . self::$newline . "]+/", self::$newline, $html);
        // replace tabs by spaces
        $html = str_replace(self::$tab, " ", $html);
        // remove double spaces
        $html = preg_replace("/\s\s+/u", " ", $html);
        return $html;
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
        switch (TYPO3_OS) { // set newline
            case "WIN" :
                self::$newline = "\r\n";
            break;
            default :
                self::$newline = "\n";
        }
        $content = $renderChildrenClosure();
        $content = self::optimize($content);
        return $content;
    }
}
