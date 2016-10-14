<?php
namespace BK2K\BootstrapPackage\UserFuncs;

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

/**
* @author Stephen Leger
*/
class TemplateWidthUserFunc {
    /**
    * Reference to the parent (calling) cObject set from TypoScript
    */
    public $cObj;

    protected $settings;
    protected $fluid = 0;
    protected $width = array();
    protected $columns = array(
        "xs" => 0,
        "sm" => 0,
        "md" => 0,
        "lg" => 0
    );


    private function getConf($conf, $key, $default, $min = 0)
    {

        if (isset($conf[$key]) || is_array($conf[$key . "."])) {
            $val = floatval($this->cObj->stdWrap($conf[$key], $conf[$key . "."]));
        } else {
            $val = $default;
        }
        if ($val < $min){
            return $default;
        }
        return $val;

    }


    private function initializeColumns($conf)
    {
        $current = 12;
        foreach ($this->columns as $key => $column) {
            $current = $this->getConf($conf, $key, $current, 1);
            $this->columns[$key] = $current;
        }
    }

    private function initializeColumnsDivider($conf)
    {
        $current = 1;
        foreach ($this->columns as $key => $column) {
            $current = $this->getConf($conf, $key, $current, $current);
            $this->columns[$key] = 12 / $current;
        }
    }

    private function getSettings()
    {
        return $GLOBALS["TSFE"]->tmpl->setup["plugin."]["bootstrap_package."]["settings."];
    }

    private function setDefault()
    {
        $container = $this->settings["grid."]["container."];
        $fluid = $this->settings["grid."]["fluid."];
        // fluid width => next container width
        $this->width = array (
            "xxs" => $container["xs"], // container xs
            "xs" => (($fluid["xs"] or $this->fluid) ? $container["sm"] : $container["xs"]),  // container sm
            "sm" => (($fluid["sm"] or $this->fluid) ? $container["md"] : $container["sm"]),  // container md
            "md" => (($fluid["md"] or $this->fluid) ? $container["lg"] : $container["md"]),  // container lg
            "lg" => (($fluid["lg"] or $this->fluid) ? $container["xl"] : $container["lg"])   // container xl
        );

    }

    private function getTemplateSize()
    {
        // handle nested templates or content elements changing layout like gridelements
        if (isset($GLOBALS["TSFE"]->register["template_size"]) and is_array($GLOBALS["TSFE"]->register["template_size"])) {
            $this->width = $GLOBALS["TSFE"]->register["template_size"]["width"];
            if ($this->width["fluid"] == 0) {
                $this->fluid = 0;
            }
        } else {
            $this->setDefault();
        }
    }


    private function registerTemplateSize()
    {

        $gutter  = $this->settings["grid."]["gutter"];
        $maxcols = $this->settings["grid."]["columns"];

        $fluid = 0;
        if ($this->fluid) {
            $fluid = 1;
        }
        $GLOBALS["TSFE"]->register["template_size"] = array(
            "fluid" => $fluid,
            "width" => array(
                "xxs" => ($this->width["xxs"] + $gutter) / $maxcols * $this->columns["xs"] - $gutter,
                "xs" => ($this->width["xs"] + $gutter) / $maxcols * $this->columns["xs"] - $gutter,
                "sm" => ($this->width["sm"] + $gutter) / $maxcols * $this->columns["sm"] - $gutter,
                "md" => ($this->width["md"] + $gutter) / $maxcols * $this->columns["md"] - $gutter,
                "lg" => ($this->width["lg"] + $gutter) / $maxcols * $this->columns["lg"] - $gutter
            )
        );
    }

    /**
    * Set number of items in row instead of columns
    * Allow different sizes than regular ones (like 5 items)
    */
    public function divide($content = "", $conf = array())
    {

        $this->settings = $this->getSettings();

        // fluid set in template config
        $this->fluid = $this->getConf($conf,"fluid",0);
        $this->initializeColumnsDivider($conf);
        $this->getTemplateSize();
        $this->registerTemplateSize();
        return $content;
    }

    /**
    * Set a number of columns (12)
    */
    public function storeToRegister($content = "", $conf = array())
    {

        $this->settings = $this->getSettings();

        // fluid set in template config
        $this->fluid = $this->getConf($conf,"fluid",0);
        $this->initializeColumns($conf);
        $this->getTemplateSize();
        $this->registerTemplateSize();
        return $content;
    }
}
