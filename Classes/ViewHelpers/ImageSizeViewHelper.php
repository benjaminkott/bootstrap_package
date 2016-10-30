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
 *
 *  Compute real image size according your layout
 *  Use this on content elements changing layout via bootstrap col-xx-yy classes
 *  or with user defined margins .. see arguments below.
 *
 *  NB: standard frames (well, jumbotron, indent) are allready taken into account
 *      in /Partials/Media/Gallery.html
 *
 *  eg:
 *  <div class="carousel-image col-xs-8" style="margin:40px;">
 *     <bk2k:imageSize xs="8" marginxs="40">
 *
 */

/**
 * @author Stephen Leger <stephen@3dservices.ch>
 */

use BK2K\BootstrapPackage\Utility\ResponsiveImagesUtility;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

class ImageSizeViewHelper extends AbstractViewHelper implements CompilableInterface
{
  
    protected $escapeOutput = false;
  
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('as', 'string', 'Variable name used to store image sizes', false, 'imagesize');
        $this->registerArgument('xs', 'float', 'Number of columns for extra small (may be a float for non standard columns number)', false, 0);
        $this->registerArgument('sm', 'float', 'Number of columns for small (may be a float for non standard columns number)', false, 0);
        $this->registerArgument('md', 'float', 'Number of columns for medium (may be a float for non standard columns number)', false, 0);
        $this->registerArgument('lg', 'float', 'Number of columns for large (may be a float for non standard columns number)', false, 0);
        $this->registerArgument('fluid', 'float', 'Container fluid', false, -1);
        $this->registerArgument('border', 'integer', 'Border size arround each image', false, 0);
        $this->registerArgument('marginxs', 'integer', 'Margin for extra small', false, 0);
        $this->registerArgument('marginsm', 'integer', 'Margin for small', false, 0);
        $this->registerArgument('marginmd', 'integer', 'Margin for medium', false, 0);
        $this->registerArgument('marginlg', 'integer', 'Margin for large', false, 0);
        // user defined fixed width, auto crop according
        $this->registerArgument('imagewidth', 'float', 'User defined width', false, 0);
        $this->registerArgument('imageheight', 'float', 'User defined height', false, 0);
        // user defined crop and image ratio
        $this->registerArgument('ratio', 'float', 'Ratio height/width in %, will crop height when > 0', false, 0);
        $this->registerArgument('crop', 'string', 'vertical crop position in % 0 = center -100 = top 100 = bottom', false, '');
        $this->registerArgument('file', 'object', 'file properties', false, null);
        $this->registerArgument('store', 'boolean', 'Compute and store number of images per row using number of columns', false, false);
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

        $as = $arguments['as'];

        // retrieve and store current size
        $size = ResponsiveImagesUtility::backupImageSize($renderingContext, $settings, $as);

        // layout change, we are now in a container
        if ($arguments['fluid'] == 0 and $size['fluid'] == 1) {
            $newSize = ResponsiveImagesUtility::getDefault($settings, false);
        } else {
            $newSize = $size;
        }

        // border width wrapping all images
        if ($arguments['border'] > 0) {
            $newSize['border'] = 2*$arguments['border'];
        }

        // user defined image ratio, will crop either width or height
        if ($arguments['ratio'] > 0) {
            $newSize['ratio'] = $arguments['ratio'] / 100;
        }

        // specify the crop in percent : -100 = left or top 100 = right or bottom
        // eg for download files thumbs
        if ($arguments['crop'] !== '') {
            $newSize['crop'] = $arguments['crop'];
        }

        // user defined image size, will override all other settings
        if ($arguments['imagewidth'] > 0) {
            $newSize['imagewidth'] = $arguments['imagewidth'];
        }

        if ($arguments['imageheight'] > 0) {
            $newSize['imageheight'] = $arguments['imageheight'];
        }

        // user defined size
        if ($arguments['imagewidth'] > 0 or $arguments['imageheight'] > 0) {
            if ($arguments['imagewidth'] > 0) {
                // width proportional to container
                $ref =  $arguments['imagewidth'] / intval($settings['grid.']['container.']['lg']);
                $newSize['xxs']['width'] = $ref * intval($settings['grid.']['container.']['xs']);
                $newSize['xs']['width'] = $ref * intval($settings['grid.']['container.']['xs']);
                $newSize['sm']['width'] = $ref * intval($settings['grid.']['container.']['sm']);
                $newSize['md']['width'] = $ref * intval($settings['grid.']['container.']['md']);
                $newSize['lg']['width'] = $arguments['imagewidth'];
            }
            if ($arguments['imageheight'] > 0) {
                // height proportional to container
                $ref =  $arguments['imageheight'] / intval($settings['grid.']['container.']['lg']);
                $newSize['xxs']['height'] = $ref * intval($settings['grid.']['container.']['xs']);
                $newSize['xs']['height'] = $ref * intval($settings['grid.']['container.']['xs']);
                $newSize['sm']['height'] = $ref * intval($settings['grid.']['container.']['sm']);
                $newSize['md']['height'] = $ref * intval($settings['grid.']['container.']['md']);
                $newSize['lg']['height'] = $arguments['imageheight'];
            }
        } else {
            // number of columns (may be a float for non standard columns number)
            $xs = floatval($arguments['xs']);
            $sm = $arguments['sm'];
            $md = $arguments['md'];
            $lg = $arguments['lg'];

            $maxcols = intval($settings['grid.']['columns']);

            if ($xs == 0) {
                $xs = $maxcols;
            }
            // inherits from smaller
            if ($sm == 0) {
                $sm = $xs;
            }

            if ($md == 0) {
                $md = $sm;
            }

            if ($lg == 0) {
                $lg = $md;
            }

            $marginxs = 2*$arguments['marginxs'];
            $marginsm = 2*$arguments['marginsm'];
            $marginmd = 2*$arguments['marginmd'];
            $marginlg = 2*$arguments['marginlg'];

            if ($marginsm == 0) {
                $marginsm = $marginxs;
            }

            if ($marginmd == 0) {
                $marginmd = $marginsm;
            }

            if ($marginlg == 0) {
                $marginlg = $marginmd;
            }

            // margins
            $newSize['xxs']['width'] -= $marginxs;
            $newSize['xs']['width'] -= $marginxs;
            $newSize['sm']['width'] -= $marginsm;
            $newSize['md']['width'] -= $marginmd;
            $newSize['lg']['width'] -= $marginlg;

            // store images per row, allow to dynamically divide available space
            // taking variable borderspace in account
            if ($arguments['store']) {
                $newSize['xxs']['cols'] = round($maxcols/$xs);
                $newSize['xs']['cols'] = round($maxcols/$xs);
                $newSize['sm']['cols'] = round($maxcols/$sm);
                $newSize['md']['cols'] = round($maxcols/$md);
                $newSize['lg']['cols'] = round($maxcols/$lg);
            } else {
                $gutter  = intval($settings['grid.']['gutter']);
                $newSize['xxs']['width'] = ($newSize['xxs']['width'] + $gutter) / $maxcols * $xs - $gutter;
                $newSize['xs']['width'] = ($newSize['xs']['width'] + $gutter) / $maxcols * $xs - $gutter;
                $newSize['sm']['width'] = ($newSize['sm']['width'] + $gutter) / $maxcols * $sm - $gutter;
                $newSize['md']['width'] = ($newSize['md']['width'] + $gutter) / $maxcols * $md - $gutter;
                $newSize['lg']['width'] = ($newSize['lg']['width'] + $gutter) / $maxcols * $lg - $gutter;
            }
        }

        $renderingContext->getTemplateVariableContainer()->add($as, $newSize);

        $content = $renderChildrenClosure();

        // restore only if the tag is closed and has childrens
        if ($content != '') {
            ResponsiveImagesUtility::restoreImageSize($renderingContext, $size, $as);
        }

        return $content;
    }
}
