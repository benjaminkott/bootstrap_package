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
 * IconViewHelper
 */
class IconViewHelper extends AbstractViewHelper
{
    /**
     * @var bool
     */
    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('icon', 'object', 'Icon to render', true);
        $this->registerArgument('height', 'int', 'Height');
        $this->registerArgument('width', 'int', 'Width');
    }

    /**
     * @return string
     */
    public function render()
    {
        $icon = $this->arguments['icon'];

        if (isset($this->arguments['width'])) {
            $icon->setWidth((int) $this->arguments['width']);
        }
        if (isset($this->arguments['height'])) {
            $icon->setHeight((int) $this->arguments['height']);
        }

        return $icon->render();
    }
}
