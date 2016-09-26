<?php
  namespace BK2K\BootstrapPackage\ViewHelpers;
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
  use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
  use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;
  /**
  * @author Benjamin Kott <info@bk2k.info>
  */
  
  class ImageSizeViewHelper extends AbstractViewHelper implements CompilableInterface
  {

    public function initializeArguments() {
      $this->registerArgument('xs', 'integer', 'Number of columns for extra small', FALSE, 12);
      $this->registerArgument('sm', 'integer', 'Number of columns for small', FALSE, 0);
      $this->registerArgument('md', 'integer', 'Number of columns for medium', FALSE, 0);
      $this->registerArgument('lg', 'integer', 'Number of columns for large', FALSE, 0);
    }

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
    * @return void
    */
    public static function renderStatic(
      array $arguments,
      \Closure $renderChildrenClosure,
      RenderingContextInterface $renderingContext
    ) {
      $templateVariableContainer = $renderingContext->getTemplateVariableContainer();
      
      $xs = $arguments['xs'];
      $sm = $arguments['sm'];
      if ($sm == 0){
        $sm = $xs;
      }
      $md = $arguments['md'];
      if ($md == 0){
        $md = $sm;
      }
      $lg = $arguments['lg'];
      if ($lg == 0){
        $lg = $md;
      }
      
      // TODO: put defaults in settings     
      
      $gutter = 30.0;
      $maxcols = 12.0;
      
      if ($templateVariableContainer->exists('width') === true) {
        $width =  $templateVariableContainer->get('width');
        $templateVariableContainer->remove('width');
      } elseif (isset($GLOBALS['TSFE']->register['template_size'])){
        $width = $GLOBALS['TSFE']->register['template_size'];
      } else {
        // TODO: put defaults in settings
        // assume fixed layout (xs always fluid) width => container width  
        $width = array (
          'xxs' => 450, // container xs
          'xs' => 720,  // container sm
          'sm' => 720,  // container sm
          'md' => 940,  // container md
          'lg' => 1140  // container lg
        );
      }
      $newWidth = array (
        'xxs' => ($width['xxs'] + $gutter) / $maxcols * $xs - $gutter,
        'xs' => ($width['xs'] + $gutter) / $maxcols * $xs - $gutter,
        'sm' => ($width['sm'] + $gutter) / $maxcols * $sm - $gutter,
        'md' => ($width['md'] + $gutter) / $maxcols * $md - $gutter,
        'lg' => ($width['lg'] + $gutter) / $maxcols * $lg - $gutter
      );
      $templateVariableContainer->add('width', $newWidth);
      
      return null;
    }
  }
  ?>
