<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers;

use BK2K\BootstrapPackage\Utility\SvgUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * InlineSvgViewHelper
 */
class InlineSvgViewHelper extends AbstractViewHelper
{
    /**
     * @var bool
     */
    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('image', 'object', 'a FAL object');
        $this->registerArgument('src', 'string', 'a path to a file');
        $this->registerArgument('class', 'string', 'Css class for the svg');
        $this->registerArgument('width', 'string', 'Width of the svg.', false);
        $this->registerArgument('height', 'string', 'Height of the svg.', false);
    }

    /**
     * @return string
     */
    public function render()
    {
        $src = (string)$this->arguments['src'];
        $image = $this->arguments['image'];
        $width = isset($this->arguments['width']) ? (int) $this->arguments['width'] : null;
        $height = isset($this->arguments['height']) ? (int) $this->arguments['height'] : null;
        $class = isset($this->arguments['class']) ? (string) $this->arguments['class'] : null;

        return SvgUtility::getInlineSvg($src, $image, $width, $height, $class);
    }
}
