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
 * parts inspired by CMSExperts\Responsiveimages
 */

use BK2K\BootstrapPackage\Utility\FileMetadataUtility;
use BK2K\BootstrapPackage\Utility\ResponsiveImagesUtility;
use TYPO3\CMS\Core\Resource\AbstractFile;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

/**
* @author Stephen Leger
*/
class ImagesLayoutViewHelper extends AbstractViewHelper implements CompilableInterface
{
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('as', 'string', 'Variable name used to store image sizes', false, 'equalsize');
        $this->registerArgument('imagesize', 'string', 'Variable name used to store image sizes', false, 'imagesize');
        $this->registerArgument('data', 'array', 'cObject data', true);
        $this->registerArgument('files', 'array', 'file properties', true);
        $this->registerArgument('settings', 'array', 'fluidtemplate settings', true);
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
    * compute rows / columns relations with respect to crop conf
    * @param int $colCount
    * @param string $w
    * @param string $h
    * @param array $files
    * @param array $imgSizes
    * @param array $relations
    * @return void
    */
    protected static function columnRelations($colCount, $w, $h, array &$files, array &$imgSizes, array &$relations)
    {
        foreach ($files as $k => $srcset) {
            foreach ($srcset['srcset'] as $j => $file) {
                $fsize = FileMetadataUtility::getDimension($file);
                $imgSizes[$k][$j] = $fsize[$w] / $fsize[$h];
                $relations[$j][(int)floor($k / $colCount)] += $imgSizes[$k][$j];
            }
        }
    }

    /**
    * Layout in rows or columns justify lengths
    * @param int $colCount
    * @param array $ordering
    * @param array $data
    * @param array $conf
    * @param array $settings
    * @param array $size
    * @param array $collection
    * @return void
    */
    protected static function layoutJustify($colCount, &$ordering, &$data, &$conf, &$settings, &$size, &$collection)
    {
        $imgCount = count($collection['files']);
        $equalSize = 1;

        switch ($data['images_layout']) {
            case 9:   // no rows equalwidth
                if ($data['imagewidth']) {
                    $equalSize = intval($data['imagewidth']);
                }
                $heightratio = floatval($conf['images.']['layout.']['columnsheightratio']) / 100;
                $widthratio = 1;
                // swwap cols/row count
                $w = 'height';
                $h = 'width';
                $rowCount = $colCount;
                $colCount = ceil($imgCount/$colCount);
                // percent of total width for columns style
                $collection['colpercent'] = 100 / $rowCount;
                break;
            case 10:  // no cols equalheight
                $rowCount = ceil($imgCount/$colCount);
                $equalSize = 1;
                if ($data['imageheight']) {
                    $equalSize = intval($data['imageheight']);
                }
                $widthratio  = 0;
                $heightratio = 1;
                // fixed height so total stay in ratio
                //$widthratio  = floatval($conf["images."]["layout."]["columnsheightratio"]) / 100;
                $w = 'width';
                $h = 'height';
        }

        $collection['imagecols'] = $colCount;

        $relations = array();
        $imgSizes  = array();
        self::columnRelations($colCount, $w, $h, $collection['files'], $imgSizes, $relations);
        $accumSize = array();
        $accumDesiredSize = array();
        $rowIdx = -1;
        $nbImgs = $imgCount + $colCount;

        foreach ($collection['files'] as $k => $srcset) {
            if (($k % $colCount) == 0) {
                // A new row starts
                // Reset accumulated net width
                foreach ($ordering as $i => $key) {
                    $accumSize[$key] = 0;
                    // Reset accumulated desired width
                    $accumDesiredSize[$key] = 0;
                }
                $nbImgs -= $colCount;
                $rowIdx++;
            }

            foreach ($ordering as $j => $key) {
                if ($nbImgs < $colCount) {
                    $gutters = ($nbImgs - 1);
                } else {
                    $gutters = ($colCount - 1);
                }
                $borderspace =  intval($conf['images.']['borderspace.'][$key]);

                $net = $size[$key]['width'] * $heightratio - $gutters * $borderspace;

                $filesTotalMax = $relations[$j][$rowIdx];

                // scale factor for images
                $scale = $filesTotalMax / $net;

                // This much size is available for the remaining images in this row/col (int)
                $availableSpace = $net - $accumSize[$key];

                // Theoretical size of resized image. (float)
                $desiredSpace = $imgSizes[$k][$j] / $scale;

                // Add this size. $accumDesiredSize becomes the desired position
                $accumDesiredSize[$key] += $desiredSpace;
                // Calculate size by comparing actual and desired position.
                // this evenly distributes rounding errors across all images in this row/col.
                $suggestedSize = round($accumDesiredSize[$key] - $accumSize[$key]);

                // finalImgSize may not exceed $availableSpace
                $finalImgSize = (int)min($availableSpace, $suggestedSize);
                $accumSize[$key] += $finalImgSize;
                $borderspace = intval($conf['images.']['borderspace.'][$key]);
                if ($equalSize > 1 and ($data['images_layout'] == 10 or $j < intval($settings['images']['breakpoint']))) {
                    $refsec = $equalSize * $size[$key]['width'] / $size['lg']['width'];
                } else {
                    // No row at some point need to remove any user defined width
                    // in order to prevent layout breaking
                    $refsec = ($size[$key]['width'] - $size[$key]['margin'] + $borderspace) / $rowCount - $borderspace;
                }

                $collection['files'][$k]['size'][$key][$w] =   $finalImgSize - $size['border'];
                $collection['files'][$k]['size'][$key][$h] =  round($refsec * $widthratio) - $size['border'];

                // when fluid, image sizes depends on layout
                // percent of width for each images
                $collection['files'][$k]['size'][$key]['percent'] = 100 * ($collection['files'][$k]['size'][$key]['width'] + $borderspace) / ($size[$key]['width'] + $borderspace);
            }
        }
    }
   /**
    * Layout "no rows and no cols"
    * @param int $colCount
    * @param array $ordering
    * @param array $data
    * @param array $conf
    * @param array $settings
    * @param array $size
    * @param array $collection
    * @return void
    */
    protected static function layoutRowCol($colCount, &$ordering, &$data, &$conf, &$settings, &$size, &$collection)
    {
        $imgCount = count($collection['files']);
        $equalSize = 1;

        switch ($data['images_layout']) {
            case 17:  // no rows top
            case 33:  // no rows bottom
                if ($data['imagewidth']) {
                    $equalSize = intval($data['imagewidth']);
                }
                $heightratio = floatval($conf['images.']['layout.']['columnsheightratio']) / 100;
                $widthratio = 1;
                // swwap cols/row count
                $w = 'height';
                $h = 'width';
                $rowCount = $colCount;
                $colCount = ceil($imgCount/$colCount);
                // percent of total width for columns style
                $collection['colpercent'] = 100 / $rowCount;
                break;

            case 34:  // no cols right
                // reverse array to reorder images while floating right
                $collection['files'] = array_reverse($collection['files']);
                // no break
            case 18:  // no cols left
                // no cols with equalheight
                $rowCount = ceil($imgCount/$colCount);
                if ($data['imageheight']) {
                    $equalSize = intval($data['imageheight']);
                }
                $heightratio = 1;
                // 0 let height depends on number of images in row
                $widthratio  = 0;
                // fixed height so total stay in ratio
                //$widthratio  = floatval($conf["images."]["layout."]["columnsheightratio"]) / 100;
                $w = 'width';
                $h = 'height';
        }

        $collection['imagecols'] = $colCount;

        $relations = array();
        $imgSizes  = array();
        self::columnRelations($colCount, $w, $h, $collection['files'], $imgSizes, $relations);

        foreach ($collection['files'] as $k => $srcset) {
            foreach ($ordering as $j => $key) {
                // scale main size to available space, may be disabled to allow more freedom
                $borderspace =  intval($conf['images.']['borderspace.'][$key]);
                $colMax = max($relations[$j]);
                $scale  = $colMax / (($size[$key]['width'] + $borderspace - ($colCount * $borderspace)) * $heightratio);
                $main = $imgSizes[$k][$j] / $scale;
                $collection['files'][$k]['size'][$key][$w] = floor($main) - $size['border'];

                // note : setting imageheight when no-cols and imagewidth when no-row is a non-sense, simply ignore it

                if ($equalSize > 1 and (($data['images_layout'] & 2) == 2 or $j < intval($settings['images']['breakpoint']))) {
                    $sec = $equalSize * $size[$key]['width'] / $size['lg']['width'];
                } else {
                    $sec = ($size[$key]['width'] + $borderspace - $size[$key]['margin']) / $rowCount - $borderspace;
                }
                $collection['files'][$k]['size'][$key][$h] = floor($sec) - $size['border'];

                // when fluid, image sizes depends on layout
                // percent of width for each images
                $collection['files'][$k]['size'][$key]['percent'] = 100 * ($collection['files'][$k]['size'][$key]['width'] + $borderspace) / ($size[$key]['width'] + $borderspace);
            }
        }
    }

   /**
    * Layout for css and items without layout
    * @param int $colCount
    * @param array $ordering
    * @param array $data
    * @param array $conf
    * @param array $settings
    * @param array $size
    * @param array $collection
    * @return void
    */
    protected static function layoutNoLayout($colCount, &$ordering, &$data, &$conf, &$settings, &$size, &$collection)
    {
        foreach ($collection['files'] as $k => $srcset) {
            foreach ($ordering as $j => $key) {
                $collection['files'][$k]['size'][$key]['height'] = $size[$key]['height'];
                $collection['files'][$k]['size'][$key]['width']  = $size[$key]['width'];
                $collection['files'][$k]['size']['selector'] = '#c' . $data['uid'];
            }
        }
    }

   /**
    * Default layout in grid
    * @param int $colCount
    * @param array $ordering
    * @param array $data
    * @param array $conf
    * @param array $settings
    * @param array $size
    * @param array $collection
    * @return void
    */
    protected static function layoutGrid($colCount, &$ordering, &$data, &$conf, &$settings, &$size, &$collection)
    {
        // number of items by row
        foreach ($ordering as $j => $key) {
            $collection['cols'][$key] = $size[$key]['cols'];
        }

        foreach ($collection['files'] as $k => $srcset) {
            foreach ($ordering as $j => $key) {
                $borderspace =  intval($conf['images.']['borderspace.'][$key]);
                $width = 0;
                $height = 0;

                if ($data['imageheight'] > 0) {
                    $height = $data['imageheight'] * $size[$key]['width'] / $size['lg']['width'] - $size['border'];
                }

                if (intval($data['imagewidth']) > 0 and $j < intval($settings['images']['breakpoint'])) {
                    $width = $data['imagewidth'] * $size[$key]['width'] / $size['lg']['width'] - $size['border'];
                } else {
                    $width = ($size[$key]['width'] + $borderspace - $size[$key]['margin']) / $size[$key]['cols'] - $borderspace - $size['border'];
                }

                $collection['files'][$k]['size'][$key]['height'] = floor($height);
                $collection['files'][$k]['size'][$key]['width']  = floor($width);
            }
        }
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
        $data = $arguments['data'];
        $as = $arguments['as'];
        $files = $arguments['files'];
        $settings = $arguments['settings'];

        $conf = ResponsiveImagesUtility::getSettings();
        $size = ResponsiveImagesUtility::getImageSize($renderingContext, $conf, $arguments['imagesize']);

        // @TODO: move this into plugin.settings ts
        $ordering = array('lg', 'md', 'sm', 'xs', 'xxs');

        $collection = array(
            'imagecols' => 0,
            'cols' => array(),
            'files' => array()
        );

        // responsiveimage integration
        foreach ($files as $k => $file) {
            $originalRecord = [
                'uid' => $file->getUid()
            ];

            // check if it is a translation
            if ($file->getProperty('sys_language_uid')) {
                $originalRecord['_LOCALIZED_UID'] = $file->getProperty('sys_language_uid');
            }

            // fetch the files
            $alternativeFiles = $GLOBALS['TSFE']->sys_page->getFileReferences('sys_file_reference', 'alternativefile', $originalRecord);
            $sortedAlternativeFiles = [];
            foreach ($alternativeFiles as $alternativeFile) {
                $label = $alternativeFile->getProperty('alternativetag');
                $sortedAlternativeFiles[$label] = $alternativeFile;
            }

            $srcset = [];

            $lastFile = $file;
            foreach ($ordering as $j => $key) {
                if ($sortedAlternativeFiles[$key]) {
                    $srcset[$j] = $sortedAlternativeFiles[$key];
                    // store it in case the next item is empty, so this one is used as well.
                    $lastFile = $sortedAlternativeFiles[$key];
                } else {
                    $srcset[$j] = $lastFile;
                }
            }

            $sizes = array();
            foreach ($ordering as $j => $key) {
                $sizes[$key] = array(
                    'width' => 0,
                    'height' => 0
                );
            }
            $collection['files'][$k] = array(
                'srcset' => $srcset,
                'size' => $sizes
            );
        }

        $imgCount = count($collection['files']);

        // limit number of cols
        $cols = intval($data['imagecols']);
        $colCount = $cols > 1 ? $cols : 1;
        if ($colCount > $imgCount) {
            $colCount = $imgCount;
        }

        switch ($data['images_layout']) {
            case 9:     // no rows equalwidth
            case 10:    // no cols equalheight
                self::layoutJustify($colCount, $ordering, $data, $conf, $settings, $size, $collection);
                // individual caption may break layout
                $globalcaption = 1;
                break;
            case 17:    // no rows top or bottom - note: bottom dosen't work
            case 33:
            case 18:    // no cols left or right
            case 34:
                self::layoutRowCol($colCount, $ordering, $data, $conf, $settings, $size, $collection);
                // individual caption may break layout
                $globalcaption = 1;
                break;
            default:
                $globalcaption = 0;
                switch ($data['image_rendering'] & 0x0F) {
                    case 0x04: // css
                        self::layoutNoLayout($colCount, $ordering, $data, $conf, $settings, $size, $collection);
                        break;
                    default:  // regular bootstrap grid
                        self::layoutGrid($colCount, $ordering, $data, $conf, $settings, $size, $collection);
                        break;
                }
        }

        // compute width and height and adjust cropping when needed
        foreach ($collection['files'] as $k => $file) {
            foreach ($ordering as $j => $key) {
                $fileratio = FileMetadataUtility::getRatio($file['srcset'][$j]);

                // here we always have width, but only sometimes the height
                // on some layouts the width may be <= 0 so make it positive > 10
                if ($collection['files'][$k]['size'][$key]['width'] < 10) {
                    $collection['files'][$k]['size'][$key]['width'] = 10;
                }

                // user defined ratio h/w
                if ($size['ratio']) {
                    $collection['files'][$k]['size'][$key]['height'] = floor($size['ratio'] * $collection['files'][$k]['size'][$key]['width']);
                } elseif (!$collection['files'][$k]['size'][$key]['height']) {
                    // if there is no height specified use the one
                    $collection['files'][$k]['size'][$key]['height'] = floor($collection['files'][$k]['size'][$key]['width'] * $fileratio);
                }

                // now we have both height and width
                // check if we need to crop and on witch side
                $ratio = $collection['files'][$k]['size'][$key]['height'] / $collection['files'][$k]['size'][$key]['width'];
                if ($fileratio > $ratio) {
                    $collection['files'][$k]['size'][$key]['cropheight'] = 'c' . $size['crop'];
                } else {
                    $collection['files'][$k]['size'][$key]['cropwidth']  = 'c' . $size['crop'];
                }

                // note : art direction may have as many source / ratio as breakpoints
                // so placeholder may be a wrong image with wrong ratio
                $collection['files'][$k]['size']['placeholder']['width']  = 50;
                $collection['files'][$k]['size']['placeholder']['height'] = floor(50 * $ratio);

                // set a height as percent of width for a css padding-bottom if needed
                // for eg: prevent relayout of pages while loading images
                $collection['files'][$k]['size'][$key]['padding'] = 100 * $collection['files'][$k]['size'][$key]['height']/ $collection['files'][$k]['size'][$key]['width'];
            }
            // allow css styling for image - eg: set absolute size in order to prevent relayout
            if (!$collection['files'][$k]['size']['selector']) {
                $collection['files'][$k]['size']['selector'] = "image-" . $data['uid'] ."-" . $k;
            }
            // disable individual caption as they may break some layouts
            $collection['files'][$k]['size']['globalcaption'] = $globalcaption;
        }

        if ($renderingContext->getTemplateVariableContainer()->exists($as) == true) {
            $renderingContext->getTemplateVariableContainer()->remove($as);
        }
        // usefull to print debug right before content.
        // $collection['error'] .= '<pre>' .print_r($settings, true) .intval($settings['images']['breakpoint']) . '</pre>';

        $renderingContext->getTemplateVariableContainer()->add($as, $collection);
        $content = $renderChildrenClosure();
        $renderingContext->getTemplateVariableContainer()->remove($as);
        return $content;
    }
}
