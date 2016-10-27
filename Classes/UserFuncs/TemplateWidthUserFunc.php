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

use BK2K\BootstrapPackage\Utility\ResponsiveImagesUtility;

/**
* @author Stephen Leger
*/
class TemplateWidthUserFunc
{
    /**
    * Reference to the parent (calling) cObject set from TypoScript
    */
    public $cObj;

    protected $settings;
    protected $fluid = 0;
    protected $imagesize = array();
    protected $columns = array(
        'xs' => 0,
        'sm' => 0,
        'md' => 0,
        'lg' => 0
    );

    private function getConf($conf, $key, $default, $min = 0)
    {
        if (isset($conf[$key]) || is_array($conf[$key . '.'])) {
            $val = floatval($this->cObj->stdWrap($conf[$key], $conf[$key . '.']));
        } else {
            $val = $default;
        }
        if ($val < $min) {
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

    private function getTemplateSize()
    {
        $register = ResponsiveImagesUtility::getImageSizeFromRegister();
        // handle nested templates or content elements changing layout like gridelements
        if ($register) {
            $this->imagesize = $register;
            if ($register['fluid'] == 0) {
                $this->fluid = 0;
            }
        } else {
            $this->imagesize = ResponsiveImagesUtility::getDefault($this->settings, $this->fluid);
        }
    }

    private function registerTemplateSize()
    {
        $maxcols = $this->settings['grid.']['columns'];
        $gutter  = $this->settings['grid.']['gutter'];

        if ($this->fluid) {
            $this->imagesize['fluid'] = 1;
        }

        $this->imagesize['xxs']['width'] = ($this->imagesize['xxs']['width'] + $gutter) * ($this->columns['xs'] / $maxcols) - $gutter;
        $this->imagesize['xs']['width'] = ($this->imagesize['xs']['width'] + $gutter) * ($this->columns['xs'] / $maxcols) - $gutter;
        $this->imagesize['sm']['width'] = ($this->imagesize['sm']['width'] + $gutter) * ($this->columns['sm'] / $maxcols) - $gutter;
        $this->imagesize['md']['width'] = ($this->imagesize['md']['width'] + $gutter) * ($this->columns['md'] / $maxcols) - $gutter;
        $this->imagesize['lg']['width'] = ($this->imagesize['lg']['width'] + $gutter) * ($this->columns['lg'] / $maxcols) - $gutter;

        ResponsiveImagesUtility::setImageSizeToRegister($this->imagesize);
    }

    /**
    * Set number of items in row instead of columns
    * Allow different sizes than regular ones (like 5 items)
    */
    public function divide($content = '', $conf = array())
    {
        $this->settings = ResponsiveImagesUtility::getSettings();

        // fluid set in template config
        $this->fluid = $this->getConf($conf, 'fluid', 0);
        $this->initializeColumnsDivider($conf);
        $this->getTemplateSize();
        $this->registerTemplateSize();
        return $content;
    }

    /**
    * Set a number of columns (12)
    */
    public function storeToRegister($content = '', $conf = array())
    {
        $this->settings = ResponsiveImagesUtility::getSettings();

        // fluid set in template config
        $this->fluid = $this->getConf($conf, 'fluid', 0);
        $this->initializeColumns($conf);
        $this->getTemplateSize();
        $this->registerTemplateSize();
        return $content;
    }
}
