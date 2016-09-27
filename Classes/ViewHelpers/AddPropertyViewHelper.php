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
  class AddPropertyViewHelper extends AbstractViewHelper
  {
    /**
    * Render
    *
    * @param mixed $object
    * @param string $name
    * @param mixed $value
    * @return void
    */
    public function render($object = null, $name = null, $value = null)
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
      if ($arguments['object'] !== null) {
        $templateVariableContainer = $renderingContext->getTemplateVariableContainer();
        if ($templateVariableContainer->exists($arguments['object']) === true) {
          $object = $templateVariableContainer->get($arguments['object']);
          $templateVariableContainer->remove($arguments['object']);

          if(is_object($object)) {
            $object->{$arguments['name']} = $arguments['value'];
          }
          elseif(is_array($object)) {
            $object[$arguments['name']] = $arguments['value'];
          }
          $templateVariableContainer->add($arguments['object'], $object);
        }
      }
      return null;
    }

  }
