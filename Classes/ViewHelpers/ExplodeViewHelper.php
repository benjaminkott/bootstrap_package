<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

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
 * <bk2k:explode data"{string}" delimiter=" " />
 * <f:debug>{items}</f:debug>
 */
class ExplodeViewHelper extends AbstractViewHelper
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
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('data', 'string', 'The input string', false);
        $this->registerArgument('as', 'string', 'Name of variable to create', false, 'items');
        $this->registerArgument('delimiter', 'string', 'The boundary string', false, "\n");
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
        $data = $arguments['data'] ?? $renderChildrenClosure();
        if (!is_string($data)) {
            return '';
        }

        $variableProvider = $renderingContext->getVariableProvider();
        $items = GeneralUtility::trimExplode($arguments['delimiter'], $data);
        $variableProvider->add($arguments['as'], $items);

        if ($arguments['data'] !== null && $renderChildrenClosure() !== null) {
            $content = $renderChildrenClosure();
            $variableProvider->remove($arguments['as']);
            return $content;
        }

        return '';
    }
}
