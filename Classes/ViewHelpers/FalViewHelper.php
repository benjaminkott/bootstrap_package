<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers;

use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * FalViewHelper
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
            $fileRepository = GeneralUtility::makeInstance(FileRepository::class);
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
                isset($GLOBALS['TCA'][$arguments['table']]['ctrl']['languageField'])
                && $GLOBALS['TCA'][$arguments['table']]['ctrl']['languageField'] !== ''
                && isset($GLOBALS['TCA'][$arguments['table']]['ctrl']['transOrigPointerField'])
                && $GLOBALS['TCA'][$arguments['table']]['ctrl']['transOrigPointerField'] !== ''
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
