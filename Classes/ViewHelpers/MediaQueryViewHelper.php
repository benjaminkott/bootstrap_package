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

class MediaQueryViewHelper extends AbstractViewHelper implements CompilableInterface
{

    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument("min", "string", "Breakpoint name min", false, null);
        $this->registerArgument("max", "string", "Breakpoint name max", false, null);
    }

    /**
    * @return string the rendered string
    * @api
    */
    public function render()
    {
        return self::renderStatic(
            $this->arguments,
            $this->buildRenderChildrenClosure(),
            $this->renderingContext
        );
    }

    private static function getSettings()
    {
        return $GLOBALS["TSFE"]->tmpl->setup["plugin."]["bootstrap_package."]["settings."];
    }

    /**
    * @param array $arguments
    * @param \Closure $renderChildrenClosure
    * @param RenderingContextInterface $renderingContext
    * @return string $content
    */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {

        $settings = self::getSettings();

        if ($arguments["min"] !== null or $arguments["max"] !== null) {
            $content .= "@media ";
        }

        if($arguments["min"] !== null) {
            $content .= " (min-width:" . $settings["grid."]["screen."][$arguments["min"]] . "px)";
            if($arguments["max"] !== null) {
                $content .= " and ";
            }
        }

        if($arguments["max"] !== null) {
            $content .= " (max-width:" . (intval($settings["grid."]["screen."][$arguments["max"]]) - 1) . "px)";
        }

        if ($arguments["min"] !== null or $arguments["max"] !== null) {
            $content .= "{";
        }

        $content .= $renderChildrenClosure();

        if ($arguments["min"] !== null or $arguments["max"] !== null) {
            $content .= "}";
        }

        return $content;
    }
}
