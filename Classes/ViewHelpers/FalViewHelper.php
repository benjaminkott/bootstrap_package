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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * @author Benjamin Kott <info@bk2k.info>
 */
class FalViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * Initialize arguments.
     *
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('data', 'array', 'Data of current record', true);
        $this->registerArgument('table', 'string', 'table', false, 'tt_content');
        $this->registerArgument('field', 'string', 'field', false, 'image');
        $this->registerArgument('as', 'string', 'Name of variable to create', false, 'items');
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $variableProvider = $renderingContext->getVariableProvider();
        if (is_array($arguments['data']) && $arguments['data']['uid'] && $arguments['data'][$arguments['field']]) {
            $fileRepository = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
            $items = $fileRepository->findByRelation(
                $arguments['table'],
                $arguments['field'],
                $arguments['data']['uid']
            );
            $localizedId = null;
            if (isset($arguments['data']['_LOCALIZED_UID'])) {
                $localizedId = $arguments['data']['_LOCALIZED_UID'];
            } elseif (isset($arguments['data']['_PAGES_OVERLAY_UID'])) {
                $localizedId = $arguments['data']['_PAGES_OVERLAY_UID'];
            }
            $isTableLocalizable = (
                !empty($GLOBALS['TCA'][$arguments['table']]['ctrl']['languageField'])
                && !empty($GLOBALS['TCA'][$arguments['table']]['ctrl']['transOrigPointerField'])
            );
            if ($isTableLocalizable && $localizedId !== null) {
                $items = $fileRepository->findByRelation($arguments['table'], $arguments['field'], $localizedId);
            }
        } else {
            $items = null;
        }
        $variableProvider->add($arguments['as'], $items);
        $content = $renderChildrenClosure();
        $variableProvider->remove($arguments['as']);
        return $content;
    }
}
