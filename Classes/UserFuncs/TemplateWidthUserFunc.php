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
  * @author Benjamin Kott <info@bk2k.info>
  */
  class TemplateWidthUserFunc {
    /**
    * Reference to the parent (calling) cObject set from TypoScript
    */
    public $cObj;
     
    public function storeToRegister($content="", $conf){
      
      $xs = 0;
      $sm = 0;
      $md = 0;
      $lg = 0;
      $fluid = 0;
      if (isset($conf['fluid.'])) {
        $fluid = (bool)$this->cObj->stdWrap($conf['fluid'], $conf['fluid.']);
      } 
      if (isset($conf['xs.'])) {
        $xs = $this->cObj->stdWrap($conf['xs'], $conf['xs.']);
      } 
      if ($xs == 0){
        $xs = 12;
      }
      if (isset($conf['sm.'])) {
        $sm = $this->cObj->stdWrap($conf['sm'], $conf['sm.']);
      } 
      if ($sm == 0){
        $sm = $xs;
      }
      if (isset($conf['md.'])) {
        $md = $this->cObj->stdWrap($conf['md'], $conf['md.']);
      } 
      if ($md == 0){
        $md = $sm;
      }
      if (isset($conf['lg.'])) {
        $lg = $this->cObj->stdWrap($conf['lg'], $conf['lg.']);
      } 
      if ($lg == 0){
        $lg = $md;
      }
      // TODO: put this into settings / plugin config as they cant stay hardcoded
      $gutter = 30;
      $maxcols = 12;
      
      // fluid width => next container width 
      if ($fluid){
        $w = array (
          'xxs' => 450, // container xs
          'xs' => 720,  // container sm
          'sm' => 940,  // container md
          'md' => 1140, // container lg
          'lg' => 1920  // container xl
        );
      } else {
        // fixed (xs always fluid) width => container width  
        $w = array (
          'xxs' => 450, // container xs
          'xs' => 720,  // container sm
          'sm' => 720,  // container sm
          'md' => 940,  // container md
          'lg' => 1140  // container lg
        );
      }
      $GLOBALS['TSFE']->register['template_size'] = array(
        'xxs' => ($w['xxs'] + $gutter) / $maxcols * floatval($xs) - $gutter,
        'xs' => ($w['xs'] + $gutter) / $maxcols * floatval($xs) - $gutter,
        'sm' => ($w['sm'] + $gutter) / $maxcols * floatval($sm) - $gutter,
        'md' => ($w['md'] + $gutter) / $maxcols * floatval($md) - $gutter,
        'lg' => ($w['lg'] + $gutter) / $maxcols * floatval($lg) - $gutter
      );
      return null;
    }
  }
 ?>
