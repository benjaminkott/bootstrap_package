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

use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;
use TYPO3\CMS\Frontend\Controller\TyposcriptFrontendController;

/**
 * @author Benjamin Kott <info@bk2k.info>
 */
class ResolveLinkViewHelper extends AbstractViewHelper implements CompilableInterface
{

    /**
     * Render
     *
     * @param string $property
     * @return string
     */
    public function render($page = null)
    {
        return self::renderStatic(
            [
                'page' => $page
            ],
            $this->buildRenderChildrenClosure(),
            $this->renderingContext
        );
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return void
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $page = $arguments['page'];
        if ($page['doktype'] == 4){  // PageRepository::DOKTYPE_SHORTCUT
            $page = $GLOBALS['TSFE']->getPageShortcut($page['shortcut'], $page['shortcut_mode'], $page['uid']);
            if ($page['hidden'] || $page['starttime'] > $GLOBALS['SIM_EXEC_TIME'] || $page['endtime'] != 0 && $page['endtime'] <= $GLOBALS['SIM_EXEC_TIME']){
                return $arguments['page']['uid'];
            }
        }
        return $page['uid'];
    }
}
