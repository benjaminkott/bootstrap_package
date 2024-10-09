<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers\Data;

use BK2K\BootstrapPackage\Utility\ImageVariantsUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * ImageVariantsViewHelper
 */
class ImageVariantsViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('as', 'string', 'Name of variable to create.', true);
        $this->registerArgument('variants', 'array', 'Variants for responsive images.', false);
        $this->registerArgument('multiplier', 'array', 'Multiplier to calculate responsive image widths.', false);
        $this->registerArgument('gutters', 'array', 'Gutter that needs to be respected when calculating responsive image widths.', false);
        $this->registerArgument('corrections', 'array', 'Corrections to be applied after calculation of image widths.', false);
        $this->registerArgument('aspectRatio', 'float', 'Set aspect ratio for all variants.', false);
    }

    /**
     * @return string
     */
    public function render()
    {
        $variants = ImageVariantsUtility::getImageVariants($this->arguments['variants'] ?? null, $this->arguments['multiplier'] ?? null, $this->arguments['gutters'] ?? null, $this->arguments['corrections'] ?? null, $this->arguments['aspectRatio'] ?? null);
        $this->renderingContext->getVariableProvider()->add($this->arguments['as'], $variants);
        return '';
    }
}
