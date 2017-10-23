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
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * @author Benjamin Kott <info@bk2k.info>
 */
class DataRelationViewHelper extends AbstractViewHelper
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
        $this->registerArgument('uid', 'integer', 'uid', true);
        $this->registerArgument('table', 'string', 'table', true);
        $this->registerArgument('foreignField', 'string', 'foreignField', false, 'tt_content');
        $this->registerArgument('selectFields', 'string', 'selectFields', false, '*');
        $this->registerArgument('as', 'string', 'Name of variable to create', false, 'items');
        $this->registerArgument('sortby', 'string', 'sortby', false, 'sorting ASC');
        $this->registerArgument('additionalWhere', 'string', 'additionalWhere', false, '');
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
        $variableProvider = $renderingContext->getVariableProvider();
        if ($arguments['uid'] !== null && $arguments['table'] !== null) {
            $connection = static::getDatabaseConnection();
            $frontendController = static::getFrontendController();
            $contentObjectRenderer = static::createContentObjectRenderer();
            $whereClause = $arguments['foreignField'] . '=' . (int)$arguments['uid']
                . ' ' . $arguments['additionalWhere']
                . $contentObjectRenderer->enableFields($arguments['table']);
            $groupBy = '';
            $limit = '';
            $connection->store_lastBuiltQuery = 1;
            $data = $connection->exec_SELECTgetRows(
                $arguments['selectFields'],
                $arguments['table'],
                $whereClause,
                $groupBy,
                $arguments['sortby'],
                $limit
            );
            $items = [];
            foreach ($data as $record) {
                $frontendController->sys_page->versionOL($arguments['table'], $record);
                if (is_array($record)) {
                    $items[] = $frontendController->sys_page->getRecordOverlay(
                        $arguments['table'],
                        $record,
                        $frontendController->sys_language_uid
                    );
                }
            }
            usort(
                $items,
                function ($a, $b) {
                    return $a['sorting'] > $b['sorting'];
                }
            );
        } else {
            $items = null;
        }
        $variableProvider->add($arguments['as'], $items);
        $content = $renderChildrenClosure();
        $variableProvider->remove($arguments['as']);
        return $content;
    }

    /**
     * @return ContentObjectRenderer
     */
    private static function createContentObjectRenderer()
    {
        return GeneralUtility::makeInstance(
            ContentObjectRenderer::class
        );
    }

    /**
     * @return \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
     */
    private static function getFrontendController()
    {
        return $GLOBALS['TSFE'];
    }

    /**
     * @return \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    private static function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }
}
