<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

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
 * <bk2k:implode data="{array}" />
 */
class ImplodeViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('data', 'array', 'Input array', false);
        $this->registerArgument('as', 'string', 'Name of variable to create', false);
        $this->registerArgument('delimiter', 'string', 'The boundary string', false, ' ');
    }

    /**
     * @return string
     */
    public function render()
    {
        $data = $this->arguments['data'] ?? $this->renderChildren();
        if (!is_array($data)) {
            return '';
        }

        $result = implode($this->arguments['delimiter'], $data);
        if ($this->arguments['as'] !== null) {
            $variableProvider = $this->renderingContext->getVariableProvider();
            $variableProvider->add($this->arguments['as'], $result);
            if ($this->arguments['data'] !== null && $this->renderChildren() !== null) {
                $content = $this->renderChildren();
                $variableProvider->remove($this->arguments['as']);
                return $content;
            }
            return '';
        }

        return $result;
    }
}
