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
*
* Compute EqualHeigth rows and columns sizes,
* include support for art direction.
*/

use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

/**
* @author Stephen Leger
*/

class EqualHeightViewHelper extends AbstractViewHelper implements CompilableInterface
{

    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument("as", "string", "Variable name used to store image sizes", false, "imagesize");
        $this->registerArgument("data", "array", "Ratio height/width in %, will crop height when > 0", true);
        $this->registerArgument("files", "object", "file properties", true);
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
    * Backups "width" state of a possible parent imageWidth ViewHelper to support nesting
    *
    * @return array $width
    */
    protected static function getSizeState(RenderingContextInterface $renderingContext, $settings, $as)
    {

        if ($renderingContext->getTemplateVariableContainer()->exists($as)) {

            $size = $renderingContext->getTemplateVariableContainer()->get($as);
            $renderingContext->getTemplateVariableContainer()->remove($as);

        } elseif (isset($GLOBALS["TSFE"]->register["template_size"])) {

            $size = $GLOBALS["TSFE"]->register["template_size"];

        } else {

            // assume fixed layout (xs always fluid) width => container width
            $container = $settings["grid."]["container."];
            $fluid = $settings["grid."]["fluid."];

            // fluid width => next container width
            $size = array (
                "width"  => array(
                    "xxs" => $container["xs"], // container xs
                    "xs" => (($fluid["xs"]) ? $container["sm"] : $container["xs"]),  // container sm
                    "sm" => (($fluid["sm"]) ? $container["md"] : $container["sm"]),  // container md
                    "md" => (($fluid["md"]) ? $container["lg"] : $container["md"]),  // container lg
                    "lg" => (($fluid["lg"]) ? $container["xl"] : $container["lg"])  // container xl
                ),
                "ratio" => 0,
                "height"  => array(
                    "xxs" => "",
                    "xs" => "",
                    "sm" => "",
                    "md" => "",
                    "lg" => ""
                ),
                "cols" => array(
                    "xs" => 1,
                    "sm" => 1,
                    "md" => 1,
                    "lg" => 1
                )
            );
        }
        return $size;
    }

    /**
    * Backups "width" state of a possible parent imageWidth ViewHelper to support nesting
    *
    * @return array $width
    */
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

        $data = $arguments["data"];
        if (!$data["image_equalHeight"]) {
            return;
        }
        $settings = self::getSettings();
        $size = self::getSizeState($renderingContext, $settings, "imagesize");
        $imgWidths = $data["image_equalHeight"]["imgWidths"];
        $relations_cols = $data["image_equalHeight"]["relations_cols"];
        $equalHeight = $data["image_equalHeight"]["equalHeight"];

        $colCount = intval($data["imagecols"]);

       
        $as = $arguments["as"];

        $newSize = array();

        // width in percent
        $container = $size["width"]["lg"];

        $breakpoints = 1;
        if (($data['image_rendering'] & 16) == 16) {
            $breakpoints = 5;
        }
        $keys = array('lg', 'md', 'sm', 'xs', 'xxs');
        $imgCount = floor(count($arguments["files"]) / $breakpoints);
        // compute columns relations with respect to crop settings
        // when we are in art direction mode compare columns between same step

        for ($j = 0; $j < $breakpoints; $j++){
            $rowIdx = 0;
            $nbImgs = $imgCount;
            for ($k = 0; $k < $imgCount; $k++) {
                if ($k % $colCount == 0) {
                    if ($nbImgs < $colCount ) {
                        $gutters = ($nbImgs - 1) * $settings["grid."]["gutter"];
                    } else {
                        $gutters = ($colCount - 1) * $settings["grid."]["gutter"];
                    }
                    $netW = $container - $gutters;
                    // A new row starts
                    // Reset accumulated net width
                    $accumWidth = 0;
                    // Reset accumulated desired width
                    $accumDesiredWidth = 0;
                    $rowTotalMaxW = $relations_cols[$j][$rowIdx];
                    $scale = $rowTotalMaxW / $netW;
                    $desiredHeight = $equalHeight / $scale;
                    $nbImgs -= $colCount;
                    $rowIdx++;
                    if(!is_array($newSize[$k])) {
                        $newSize[$k] = array(
                            'width' => array(),
                            'height' => array()
                        );
                    }
                }
                // This much width is available for the remaining images in this row (int)
                $availableWidth = $netW - $accumWidth;
                // Theoretical width of resized image. (float)
                $desiredWidth = $imgWidths[$j+$k*$breakpoints] / $scale;
                // Add this width. $accumDesiredWidth becomes the desired horizontal position
                $accumDesiredWidth += $desiredWidth;
                // Calculate width by comparing actual and desired horizontal position.
                // this evenly distributes rounding errors across all images in this row.
                $suggestedWidth = round($accumDesiredWidth - $accumWidth);
                // finalImgWidth may not exceed $availableWidth
                $finalImgWidth = (int)min($availableWidth, $suggestedWidth);
                $accumWidth += $finalImgWidth;

                $refwidth =  $finalImgWidth / $netW;
                $refheight = $equalHeight / $netW;

                if ($breakpoints == 1) {
                    // breakpoints share the same ratio
                    foreach($keys as $i=>$key){
                        $newSize[$k]['width'][$key]  = $refwidth  * ($size["width"][$key] - $gutters);
                        $newSize[$k]['height'][$key] = round($refheight * ($size["width"][$key] - $gutters)) .'c';
                    }
                    
                } else {
                    $key = $keys[$j];
                    $newSize[$k]['width'][$key]  = $refwidth  * ($size["width"][$key] - $gutters);
                    $newSize[$k]['height'][$key] = round($refheight * ($size["width"][$key] - $gutters)) .'c';
                }
            }

        }
        if ($renderingContext->getTemplateVariableContainer()->exists($as) == true){
            $renderingContext->getTemplateVariableContainer()->remove($as);
        }
        $renderingContext->getTemplateVariableContainer()->add($as, $newSize);
        $content = $renderChildrenClosure();
        $renderingContext->getTemplateVariableContainer()->remove($as);
        return $content;
    }
}
