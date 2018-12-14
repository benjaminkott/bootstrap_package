<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

/**
 * FalViewHelper
 */
class FalViewHelper extends AbstractViewHelper implements CompilableInterface
{
    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * Render
     *
     * @param array $data
     * @param string $as
     * @param string $table
     * @param string $field
     * @return string
     */
    public function render($data, $as = 'items', $table = 'tt_content', $field = 'image')
    {
        return self::renderStatic(
            [
                'data' => $data,
                'as' => $as,
                'table' => $table,
                'field' => $field
            ],
            $this->buildRenderChildrenClosure(),
            $this->renderingContext
        );
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
        $templateVariableContainer = $renderingContext->getTemplateVariableContainer();
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
        $templateVariableContainer->add($arguments['as'], $items);
        $content = $renderChildrenClosure();
        $templateVariableContainer->remove($arguments['as']);
        return $content;
    }
}
