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
use BK2K\BootstrapPackage\Utility\ResponsiveImagesUtility;
use BK2K\BootstrapPackage\Utility\FileMetadataUtility;

/**
    * @author Stephen Leger
*/

class ImageSizeViewHelper extends AbstractViewHelper implements CompilableInterface
{

    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument("as", "string", "Variable name used to store image sizes", false, "imagesize");
        $this->registerArgument("xs", "float", "Number of columns for extra small", false, 0);
        $this->registerArgument("sm", "float", "Number of columns for small", false, 0);
        $this->registerArgument("md", "float", "Number of columns for medium", false, 0);
        $this->registerArgument("lg", "float", "Number of columns for large", false, 0);
        $this->registerArgument("border", "integer", "Border size of each image", false, 0);
        $this->registerArgument("marginxs", "integer", "Margin for extra small", false, 0);
        $this->registerArgument("marginsm", "integer", "Margin for small", false, 0);
        $this->registerArgument("marginmd", "integer", "Margin for medium", false, 0);
        $this->registerArgument("marginlg", "integer", "Margin for large", false, 0);
        // user defined fixed width, auto crop according
        $this->registerArgument("imagewidth", "float", "User defined width", false, 0);
        $this->registerArgument("imageheight", "float", "User defined height", false, 0);
        // user defined crop and image ratio
        $this->registerArgument("ratio", "float", "Ratio height/width in %, will crop height when > 0", false, 0);
        $this->registerArgument("crop", "string", "vertical crop position in % 0 = center -100 = top 100 = bottom", false, "");
        $this->registerArgument("file", "object", "file properties", false, null);
        $this->registerArgument("store", "boolean", "Compute and store number of images per row using number of columns", false, false);
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

        $settings = ResponsiveImagesUtility::getSettings();

        $as = $arguments["as"];

        // automatic size (containers)
        $size = ResponsiveImagesUtility::backupImageSize($renderingContext, $settings, $as);

        // copy
        $newSize = $size;

        if ($arguments["border"] > 0) {
            $newSize["border"] = 2*$arguments["border"];
        }
        // user defined image ratio, will crop either width or height
        // require file argument to work correctly
        if ($arguments["ratio"] > 0) {
            $newSize["ratio"] = $arguments["ratio"] / 100;
        }

        // specify the crop in percent : -100 = left or top 100 = right or bottom
        // eg for download files thumbs
        if ($arguments["crop"] !== "") {
            $newSize["crop"] = $arguments["crop"];
        }

        // user defined image size, will override all other settings
        if ($arguments["imagewidth"] > 0) {
            $newSize["imagewidth"] = $arguments["imagewidth"];
        }

        if ($arguments["imageheight"] > 0) {
            $newSize["imageheight"] = $arguments["imageheight"];
        }


        // user defined size
        if ($arguments["imagewidth"] > 0 or $arguments["imageheight"] > 0) {
            if ($arguments["imagewidth"] > 0) {
                // width proportional to container
                $ref =  $arguments["imagewidth"] / intval($settings["grid."]["container."]["lg"]);
                $newSize["xxs"]["width"] = $ref * intval($settings["grid."]["container."]["xs"]);
                $newSize["xs"]["width"] = $ref * intval($settings["grid."]["container."]["xs"]);
                $newSize["sm"]["width"] = $ref * intval($settings["grid."]["container."]["sm"]);
                $newSize["md"]["width"] = $ref * intval($settings["grid."]["container."]["md"]);
                $newSize["lg"]["width"] = $arguments["imagewidth"];
            }
            if ($arguments["imageheight"] > 0) {
                // height proportional to container
                $ref =  $arguments["imageheight"] / intval($settings["grid."]["container."]["lg"]);
                $newSize["xxs"]["height"] = $ref * intval($settings["grid."]["container."]["xs"]);
                $newSize["xs"]["height"] = $ref * intval($settings["grid."]["container."]["xs"]);
                $newSize["sm"]["height"] = $ref * intval($settings["grid."]["container."]["sm"]);
                $newSize["md"]["height"] = $ref * intval($settings["grid."]["container."]["md"]);
                $newSize["lg"]["height"] = $arguments["imageheight"];
            }
        } else {
            $xs = $arguments["xs"];
            $sm = $arguments["sm"];
            $md = $arguments["md"];
            $lg = $arguments["lg"];

            $maxcols = intval($settings["grid."]["columns"]);

            if ($xs == 0) {
                $xs = 12;
            }
            // propage le nombre de colonnes
            if ($sm == 0) {
                $sm = $xs;
            }

            if ($md == 0) {
                $md = $sm;
            }

            if ($lg == 0) {
                $lg = $md;
            }

            // images per row
            if ($arguments["store"]) {
                $newSize["xxs"]["cols"] = round($maxcols/$xs);
                $newSize["xs"]["cols"] = round($maxcols/$xs);
                $newSize["sm"]["cols"] = round($maxcols/$sm);
                $newSize["md"]["cols"] = round($maxcols/$md);
                $newSize["lg"]["cols"] = round($maxcols/$lg);
            } else {
                $gutter  = intval($settings["grid."]["gutter"]);
                $newSize["xxs"]["width"] = ($size["xxs"]["width"] + $gutter) / $maxcols * $xs - $gutter;
                $newSize["xs"]["width"] = ($size["xs"]["width"] + $gutter) / $maxcols * $xs - $gutter;
                $newSize["sm"]["width"] = ($size["sm"]["width"] + $gutter) / $maxcols * $sm - $gutter;
                $newSize["md"]["width"] = ($size["md"]["width"] + $gutter) / $maxcols * $md - $gutter;
                $newSize["lg"]["width"] = ($size["lg"]["width"] + $gutter) / $maxcols * $lg - $gutter;
            }
        }

        $marginxs = 2*$arguments["marginxs"];
        $marginsm = 2*$arguments["marginsm"];
        $marginmd = 2*$arguments["marginmd"];
        $marginlg = 2*$arguments["marginlg"];

        if ($marginsm == 0) {
            $marginsm = $marginxs;
        }

        if ($marginmd == 0) {
            $marginmd = $marginsm;
        }

        if ($marginlg == 0) {
            $marginlg = $marginmd;
        }

        $newSize["xxs"]["margin"] += $marginxs;
        $newSize["xs"]["margin"] += $marginxs;
        $newSize["sm"]["margin"] += $marginsm;
        $newSize["md"]["margin"] += $marginmd;
        $newSize["lg"]["margin"] += $marginlg;

        $renderingContext->getTemplateVariableContainer()->add($as, $newSize);

        $content = $renderChildrenClosure();

        // restore only if the tag is closed and has childrens
        if ($content != "") {
            ResponsiveImagesUtility::restoreImageSize($renderingContext, $size, $as);
        }

        return $content;
    }
}
