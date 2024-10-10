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
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * FalViewHelper
 */
class FalViewHelper extends AbstractViewHelper
{
    /**
     * @var bool
     */
    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('data', 'array', 'Data of current record', true);
        $this->registerArgument('table', 'string', 'table', false, 'tt_content');
        $this->registerArgument('field', 'string', 'field', false, 'image');
        $this->registerArgument('as', 'string', 'Name of variable to create', false, 'items');
    }

    /**
     * @return string
     */
    public function render()
    {
        $variableProvider = $this->renderingContext->getVariableProvider();
        if (is_array($this->arguments['data']) && $this->arguments['data']['uid'] && $this->arguments['data'][$this->arguments['field']]) {
            $fileRepository = GeneralUtility::makeInstance(FileRepository::class);
            $items = $fileRepository->findByRelation(
                $this->arguments['table'],
                $this->arguments['field'],
                $this->arguments['data']['uid']
            );
            $localizedId = null;
            if (isset($this->arguments['data']['_LOCALIZED_UID'])) {
                $localizedId = $this->arguments['data']['_LOCALIZED_UID'];
            } elseif (isset($this->arguments['data']['_PAGES_OVERLAY_UID'])) {
                $localizedId = $this->arguments['data']['_PAGES_OVERLAY_UID'];
            }
            $isTableLocalizable = (
                isset($GLOBALS['TCA'][$this->arguments['table']]['ctrl']['languageField'])
                && $GLOBALS['TCA'][$this->arguments['table']]['ctrl']['languageField'] !== ''
                && isset($GLOBALS['TCA'][$this->arguments['table']]['ctrl']['transOrigPointerField'])
                && $GLOBALS['TCA'][$this->arguments['table']]['ctrl']['transOrigPointerField'] !== ''
            );
            if ($isTableLocalizable && $localizedId !== null) {
                $items = $fileRepository->findByRelation($this->arguments['table'], $this->arguments['field'], $localizedId);
            }
        } else {
            $items = null;
        }

        $variableProvider->add($this->arguments['as'], $items);
        $content = $this->renderChildren();
        $variableProvider->remove($this->arguments['as']);

        return $content;
    }
}
