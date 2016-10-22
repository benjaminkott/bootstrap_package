<?php

namespace BK2K\BootstrapPackage\Utility;

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

/**
 * @author Benjamin Kott <info@bk2k.info>
 */
class ResponsiveImagesUtility
{


   /**
    * getTyposcriptFrontendController
    * @return \TYPO3\CMS\Frontend\Controller\TyposcriptFrontendController $tsfe
    */
    protected static function getTyposcriptFrontendController()
    {
        return $GLOBALS["TSFE"];
    }

   /**
    * Retrieve "defaults"
    * @param array $settings
    * @param boolean $overridefluid
    * @return array $imagesize
    */
    public static function getDefault($settings, $overridefluid = false)
    {
        // assume fixed layout (xs always fluid) width => container width
        $screen    = $settings["grid."]["screen."];
        $container = $settings["grid."]["container."];
        $fluid     = $settings["grid."]["fluid."];
        $gutter    = $settings["grid."]["gutter"];

        // fluid width => next container width
        return array (
            "fluid" => 0,
            "xxs" => array (
                "width" => $screen["xs"] - $gutter, // container xs
                "height" => 0,
                "cols" => 1,
                "margin" => 0
            ),
            "xs" => array (
                "width" =>  (($fluid["xs"] or $overridefluid ) ? $screen["sm"] - $gutter : $container["xs"]),  // container sm
                "height" => 0,
                "cols" => 1,
                "margin" => 0
            ),
            "sm" =>  array (
                "width" => (($fluid["sm"] or $overridefluid ) ? $screen["md"] - $gutter : $container["sm"]),  // container md
                "height" => 0,
                "cols" => 1,
                "margin" => 0
            ),
            "md" => array (
                "width" =>  (($fluid["md"] or $overridefluid ) ? $screen["lg"] - $gutter : $container["md"]),  // container lg
                "height" => 0,
                "cols" => 1,
                "margin" => 0
            ),
            "lg" => array (
                "width" =>  (($fluid["lg"] or $overridefluid ) ? $screen["xl"] - $gutter : $container["lg"]),  // container xl
                "height" => 0,
                "cols" => 1,
                "margin" => 0
            ),
            "imagewidth" => 0,
            "imageheight" => 0,
            "ratio" => 0,
            "crop" => "",
            "border" => 0,
        );
    }


   /**
    * Retrieve "imagesize" from register
    * @return array $imagesize
    */
    public static function getImageSizeFromRegister()
    {
        $register = self::getTyposcriptFrontendController()->register;
        return isset($register["template_size"]) ? $register["template_size"] : false;
    }

   /**
    * Set "imagesize" to register
    * @param boolean $fluid
    * @param array $imagesize
    */
    public static function setImageSizeToRegister($imagesize)
    {
        self::getTyposcriptFrontendController()->register["template_size"] = $imagesize;
    }
   /**
    * Retrieve "imagesize"
    * @param RenderingContextInterface  $renderingContext
    * @param array $settings
    * @param string $as
    * @return array $imagesize
    */
    public static function getImageSize(RenderingContextInterface  $renderingContext, $settings, $as = "imagesize")
    {
        if ($renderingContext->getTemplateVariableContainer()->exists($as)) {
            $imagesize = $renderingContext->getTemplateVariableContainer()->get($as);
        } elseif ( self::getImageSizeFromRegister() ) {
            $imagesize = self::getImageSizeFromRegister();
        } else {
            // If not found return default
            $imagesize = self::getDefault($settings);
        }
        return $imagesize;
    }

   /**
    * Retrieve and backups "imagesize" state of a possible parent ViewHelper to support nesting
    * @param RenderingContextInterface  $renderingContext
    * @param array $settings
    * @param string $as
    * @return array $imagesize
    */
    public static function backupImageSize(RenderingContextInterface  $renderingContext, $settings, $as = "imagesize")
    {
        $imagesize = self::getImageSize($renderingContext, $settings, $as);

        if ($renderingContext->getTemplateVariableContainer()->exists($as)) {
            $renderingContext->getTemplateVariableContainer()->remove($as);
        }
        return $imagesize;
    }


    /**
    * Restore "imagesize" state  that might have been backed up in backupImageSizeState() before
    * @param RenderingContextInterface  $renderingContext
    * @param array $imagesize
    * @param string $as
    * @return void
    */
    public static function restoreImageSize(RenderingContextInterface $renderingContext, array $imagesize, $as = "imagesize")
    {
        if ($renderingContext->getTemplateVariableContainer()->exists($as)) {
            $renderingContext->getTemplateVariableContainer()->remove($as);
        }
        $renderingContext->getTemplateVariableContainer()->add($as, $imagesize);
    }

    /**
    * Retrieve plugin settings from setup
    * @return array $settings
    */
    public static function getSettings()
    {
        return self::getTyposcriptFrontendController()->tmpl->setup["plugin."]["bootstrap_package."]["settings."];
    }
}
