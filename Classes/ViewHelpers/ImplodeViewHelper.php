<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * ImplodeViewHelper.
 *
 * Example: Returns result string
 * {array -> bk2k:implode(delimiter: '')}
 *
 * Example: Assigns variable named string with contents
 * {array -> bk2k:implode(delimiter: '', as: 'string')}
 * {string}
 *
 * Example: Assigns variable named string with contents within the tags
 * <bk2k:implode data="{array}" as="string">{string}</bk2k:implode>
 *
 * Example: Returns result string
 * <bk2k:implode data"{array}" />
 */
class ImplodeViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * Initialize arguments.
     *
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('data', 'array', 'Input array', false);
        $this->registerArgument('as', 'string', 'Name of variable to create', false);
        $this->registerArgument('delimiter', 'string', 'The boundary string', false, ' ');
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
        if (!is_array($data)) {
            return '';
        }

        $result = implode($arguments['delimiter'], $data);
        if ($arguments['as'] !== null) {
            $variableProvider = $renderingContext->getVariableProvider();
            $variableProvider->add($arguments['as'], $result);
            if ($arguments['data'] !== null && $renderChildrenClosure() !== null) {
                $content = $renderChildrenClosure();
                $variableProvider->remove($arguments['as']);
                return $content;
            }
            return '';
        }

        return $result;
    }
}
