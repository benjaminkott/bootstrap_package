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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

/**
* @author Stephen Leger
*/
class JsFooterInlineViewHelper extends AbstractViewHelper implements CompilableInterface
{
    public function initializeArguments()
    {
        parent::registerArgument();
        $this->registerArgument('inline', 'boolean', 'When set, add js to body', false, false);
        $this->registerArgument('key', 'string', 'Unique id for js content', false, false);
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
    * @return string
    */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $content = '';
        $js = $renderChildrenClosure();
        $js = preg_replace("/<(\/)?script([^>]+)?>/", '', $js);
        $js = GeneralUtility::minifyJavaScript($js);

        // put css background to header or leave inline
        if ($arguments['inline']) {
            $content = '<script>' . $js . '</script>';
        } else {
            if (isset($arguments['key'])) {
                $name = $arguments['key'];
            } else {
                $name = uniqid('bootstrap_package_');
            }
            $GLOBALS['TSFE']->getPageRenderer()->addJsFooterInlineCode($name, $js, $compress = false, $forceOnTop = false);
        }
        return $content;
    }
}
