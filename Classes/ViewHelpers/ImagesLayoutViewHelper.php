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
use BK2K\BootstrapPackage\Utility\ResponsiveImagesUtility;
use BK2K\BootstrapPackage\Utility\FileMetadataUtility;

/**
* @author Stephen Leger
*/

class ImagesLayoutViewHelper extends AbstractViewHelper implements CompilableInterface
{

    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument("as", "string", "Variable name used to store image sizes", false, "equalsize");
        $this->registerArgument("imagesize", "string", "Variable name used to store image sizes", false, "imagesize");
        $this->registerArgument("data", "array", "Ratio height/width in %, will crop height when > 0", true);
        $this->registerArgument("files", "array", "file properties", true);
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


        $data = $arguments["data"];
        $as = $arguments["as"];

        $settings = ResponsiveImagesUtility::getSettings();
        $size = ResponsiveImagesUtility::getImageSize($renderingContext, $settings, $arguments["imagesize"]);

        $keys = array("lg", "md", "sm", "xs", "xxs");


        $breakpoints = 1;
        $artDirection = 0;
        $files = $arguments['files'];
        $collection = array(
            "debug" => array(),
            "imagecols" => 0,
            "cols" => array(),
            "files" => array()
        );

        if (($data["image_rendering"] & 16) == 16) {
            $artDirection = 1;
            $breakpoints = 5;
            $imgCount = count($arguments['files']);

            if (($imgCount %  $breakpoints) > 0) {
                $collection['error'] = "Art direction require a multiple of " . $breakpoints . " images, found :" . $imgCount;
            }

            $imgCount -= ($imgCount %  $breakpoints);
            $files = array_splice($arguments['files'], 0, $imgCount);
        }

        $files = array_chunk($files, $breakpoints);
        $imgCount = count($files);

        // limit number of cols
        $cols = intval($data['imagecols']);
        $colCount = $cols > 1 ? $cols : 1;
        if ($colCount > $imgCount) {
            $colCount = $imgCount;
        }

        switch ($data['images_layout']) {
            case 9:   // no rows equalsize
            case 17:  // no rows top
            case 33:  // no rows bottom
                $equalSize = 1;
                if ($data['imagewidth']) {
                    $equalSize = intval($data['imagewidth']);
                }
                $heightratio = floatval($settings["images."]["layout."]["columnsheightratio"]) / 100;
                $widthratio = 1;
                // swwap cols/row count
                $w = "height";
                $h = "width";
                $rowCount = $colCount;
                $colCount = ceil($imgCount/$colCount);
                // percent of total width for columns style
                $collection["colpercent"] = 100 / $rowCount;
                break;

            case 10:  // no cols equalsize
            case 18:  // no cols left
            case 34:  // no cols right
                // no cols with equalheight
                $rowCount = ceil($imgCount/$colCount);
                $equalSize = 1;
                if ($data['imageheight']) {
                    $equalSize = intval($data['imageheight']);
                }
                $heightratio = 1;
                // 0 let height depends on number of images in row
                $widthratio  = 0;
                // fixed height so total stay in ratio
                //$widthratio  = floatval($settings["images."]["layout."]["columnsheightratio"]) / 100;
                $w = "width";
                $h = "height";
        }

        $collection["imagecols"] = $colCount;


        // $collection["debug"] = array();
        for ($k = 0; $k < $imgCount; $k++) {
            $sizes = array();
            foreach ($keys as $j => $key) {
                $sizes[$key] = array(
                    "width" => 0,
                    "height" => 0
                );
            }
            $collection["files"][$k] = array(
                "srcset" => $files[$k],
                "size" => $sizes
            );
        }
        switch ($data['images_layout']) {
            case 9:
            case 10:
            case 17:
            case 33:
            case 18:
            case 34:
                $relations = array();
                $imgSizes  = array();

                // compute rows / columns relations with respect to crop settings
                // when we are in art direction mode compare columns between same breakpoint
                for ($j = 0; $j < $breakpoints; $j++) {
                    for ($k = 0; $k < $imgCount; $k++) {
                        $fsize = FileMetadataUtility::getDimension($files[$k][$j]);
                        $imgSizes[$k][$j] = $fsize[$w] * $equalSize / $fsize[$h];
                        $relations[$j][(int)floor($k / $colCount)] += $imgSizes[$k][$j];
                    }
                }
                break;
        }
        switch ($data['images_layout']) {
            case 9:     // no rows equalwidth
            case 10:    // no cols equalheight
                $accumSize = array();
                $accumDesiredSize = array();
                $rowIdx = -1;
                $nbImgs = $imgCount + $colCount;

                for ($k = 0; $k < $imgCount; $k++) {
                    if (($k % $colCount) == 0) {
                        // A new row starts
                        // Reset accumulated net width
                        foreach ($keys as $i => $key) {
                            $accumSize[$key] = 0;
                            // Reset accumulated desired width
                            $accumDesiredSize[$key] = 0;
                        }
                        $nbImgs -= $colCount;
                        $rowIdx++;
                    }

                    foreach ($keys as $j => $key) {
                        if ($nbImgs < $colCount) {
                            $gutters = ($nbImgs - 1);
                        } else {
                            $gutters = ($colCount - 1);
                        }

                        $net = $size[$key]["width"] * $heightratio - $gutters * intval($settings["images."]["borderspace."][$key]);

                        $filesTotalMax = $relations[$j*$artDirection][$rowIdx];

                        // scale factor for images
                        $scale = $filesTotalMax / $net;

                        // This much size is available for the remaining images in this row/col (int)
                        $availableSpace = $net - $accumSize[$key];

                        // Theoretical size of resized image. (float)
                        $desiredSpace = $imgSizes[$k][$j*$artDirection] / $scale;

                        // Add this size. $accumDesiredSize becomes the desired position
                        $accumDesiredSize[$key] += $desiredSpace;
                        // Calculate size by comparing actual and desired position.
                        // this evenly distributes rounding errors across all images in this row/col.
                        $suggestedSize = round($accumDesiredSize[$key] - $accumSize[$key]);

                        // finalImgSize may not exceed $availableSpace
                        $finalImgSize = (int)min($availableSpace, $suggestedSize);
                        $accumSize[$key] += $finalImgSize;
                        $borderspace = intval($settings["images."]["borderspace."][$key]);
                        if ($equalSize > 5 and ($data['images_layout'] == 10 or $j < intval($settings['grid.']['fluid.']['breakpoint']))) {
                            $refsec = $equalSize * $size[$key]["width"] / $size["lg"]["width"];
                        } else {
                            // No row at some point need to remove any user defined width
                            // in order to prevent layout breaking
                            $refsec = ($size[$key]["width"] - $size[$key]["margin"] + $borderspace) / $rowCount - $borderspace;
                        }


                        $final = array();
                        $final['width'] =   $finalImgSize - $size["border"];
                        $final['height'] =  round($refsec * $widthratio) - $size["border"];

                        // percent of width for each images, to enforce correct layout of tables in IE for fluid layouts
                        $collection["files"][$k]["size"][$key]["percent"] = 100 * $final[$w] / $size[$key]["width"];

                        $collection["files"][$k]["size"][$key][$w] = $final['width'];
                        $collection["files"][$k]["size"][$key][$h] = $final['height'];
                        // width in percent so we are able to force the width on ie by css
                    }
                }
                break;
            case 17:    // no rows top or bottom
            case 33:
            case 18:    // no cols left or right
            case 34:
                for ($k = 0; $k < $imgCount; $k++) {
                    foreach ($keys as $j => $key) {
                        // scale main size to available space, may be disabled to allow more freedom
                        $borderspace =  intval($settings["images."]["borderspace."][$key]);
                        $colMax = max($relations[$j * $artDirection]);
                        $scale  = $colMax / ($size[$key]["width"] * $heightratio);
                        $height = $imgSizes[$k][$j * $artDirection] / $scale;
                        $collection["files"][$k]["size"][$key][$w] = round($height) - $size["border"];

                        // note : setting imageheight here is a non-sense, simply ignore it

                        if ($equalSize > 1 and $j < intval($settings['grid.']['fluid.']['breakpoint'])) {
                            $width  = $equalSize * $size[$key]["width"] / $size["lg"]["width"];
                        } else {
                            $width = ($size[$key]["width"] + $borderspace - $size[$key]["margin"]) / $rowCount - $borderspace;
                        }
                        $collection["files"][$k]["size"][$key][$h] = round($width) - $size["border"];
                    }
                }
                break;
            default:
                switch ($data["image_rendering"] & 15) {
                    case 4: // css
                        for ($k = 0; $k < $imgCount; $k++) {
                            foreach ($keys as $j => $key) {
                                $collection["files"][$k]["size"][$key]["height"] = $size[$key]["height"];
                                $collection["files"][$k]["size"][$key]["width"]  = $size[$key]["width"];
                            }
                        }
                        // add css selector if missing for eg textpic with background
                        if ($data['image_cssselector'] == "") {
                            $data['image_cssselector'] = "#c" . $data['uid'];
                            if ($renderingContext->getTemplateVariableContainer()->exists('data') == true) {
                                $renderingContext->getTemplateVariableContainer()->remove('data');
                            }
                            $renderingContext->getTemplateVariableContainer()->add('data', $data);
                        }
                        break;
                    default:
                        // number of items by row
                        foreach ($keys as $j => $key) {
                            $collection["cols"][$key] = $size[$key]["cols"];
                        }
                        for ($k = 0; $k < $imgCount; $k++) {
                            foreach ($keys as $j => $key) {
                                $borderspace =  intval($settings["images."]["borderspace."][$key]);
                                $width = 0;
                                $height = 0;

                                if ($data['imageheight'] > 0) {
                                    $height = $data['imageheight'] * $size[$key]["width"] / $size["lg"]["width"] - $size["border"];
                                }

                                if ($data['imagewidth'] > 0 and $j < intval($settings['grid.']['fluid.']['breakpoint'])) {
                                    $width = $data['imagewidth'] * $size[$key]["width"] / $size["lg"]["width"] - $size["border"];
                                } else {
                                    $width = ($size[$key]["width"] + $borderspace - $size[$key]["margin"]) / $size[$key]["cols"] - $borderspace - $size["border"];
                                }

                                if ($size['ratio']) {
                                    $height = $width * $size['ratio'];
                                }

                                $collection["files"][$k]["size"][$key]["height"] = round($height);
                                $collection["files"][$k]["size"][$key]["width"]  = round($width);
                            }
                        }
                        break;
                }
        }


        // compute width and height and adjust cropping when needed
        for ($k = 0; $k < $imgCount; $k++) {
            foreach ($keys as $j => $key) {
                $fileratio = FileMetadataUtility::getRatio($files[$k][$j*$artDirection]);
                if ($collection["files"][$k]["size"][$key]["width"] and $collection["files"][$k]["size"][$key]["height"]) {
                    if ($fileratio > $collection["files"][$k]["size"][$key]["height"]/ $collection["files"][$k]["size"][$key]["width"]) {
                        $collection["files"][$k]["size"][$key]['cropheight'] = "c";
                    } else {
                        $collection["files"][$k]["size"][$key]['cropwidth'] = "c";
                    }
                } elseif ($collection["files"][$k]["size"][$key]["width"]) {
                    $collection["files"][$k]["size"][$key]["height"] = $collection["files"][$k]["size"][$key]["width"] * $fileratio;
                } else {
                    $collection["files"][$k]["size"][$key]["width"] = $collection["files"][$k]["size"][$key]["height"] / $fileratio;
                }
                $collection["files"][$k]["size"][$key]["padding"] = 100* $collection["files"][$k]["size"][$key]["height"]/ $collection["files"][$k]["size"][$key]["width"];
            }
            // allow css styling for image
            // $collection["files"][$k]["size"]["selector"] = "image-" . $data['uid'] ."-" . $k;
        }

        if ($renderingContext->getTemplateVariableContainer()->exists($as) == true) {
            $renderingContext->getTemplateVariableContainer()->remove($as);
        }

        $renderingContext->getTemplateVariableContainer()->add($as, $collection);
        $content = $renderChildrenClosure();
        $renderingContext->getTemplateVariableContainer()->remove($as);
        return $content;
    }
}
