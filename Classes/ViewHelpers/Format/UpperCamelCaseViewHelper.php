<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers\Format;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * UpperCamelCaseViewHelper
 */
class UpperCamelCaseViewHelper extends AbstractViewHelper
{
    /**
     * @return string
     */
    public function render()
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower($this->renderChildren()))));
    }
}
