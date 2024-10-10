<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * ExplodeViewHelper.
 *
 * Example: Assigns variable named items with the resulting array
 * {string -> bk2k:explode(delimiter: ' ', as: 'items')}
 * <f:debug>{items}</f:debug>
 *
 * Example: Assigns variable named items with the resulting array within the tags
 * <bk2k:explode data="{array}" delimiter=" " as="items"><f:debug>{items}</f:debug></bk2k:explode>
 *
 * Example: Assigns variable named items with the resulting array
 * <bk2k:explode data="{string}" delimiter=" " />
 * <f:debug>{items}</f:debug>
 */
class ExplodeViewHelper extends AbstractViewHelper
{
    /**
     * @var bool
     */
    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('data', 'string', 'The input string', false);
        $this->registerArgument('as', 'string', 'Name of variable to create', false, 'items');
        $this->registerArgument('delimiter', 'string', 'The boundary string', false, "\n");
    }

    /**
     * @return string
     */
    public function render()
    {
        $data = $this->arguments['data'] ?? $this->renderChildren();
        if (!is_string($data)) {
            return '';
        }

        $variableProvider = $this->renderingContext->getVariableProvider();
        $items = GeneralUtility::trimExplode($this->arguments['delimiter'], $data);
        $variableProvider->add($this->arguments['as'], $items);

        if ($this->arguments['data'] !== null && $this->renderChildren() !== null) {
            $content = $this->renderChildren();
            $variableProvider->remove($this->arguments['as']);
            return $content;
        }

        return '';
    }
}
