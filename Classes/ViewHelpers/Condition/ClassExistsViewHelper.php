<?php

declare(strict_types=1);

namespace BK2K\BootstrapPackage\ViewHelpers\Condition;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractConditionViewHelper;

final class ClassExistsViewHelper extends AbstractConditionViewHelper
{
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('class', 'string', 'The class name. The name is matched in a case-insensitive manner.', true);
    }

    /**
     * @param array{class: string} $arguments
     */
    public static function verdict(array $arguments, RenderingContextInterface $renderingContext): bool
    {
        return class_exists($arguments['class']);
    }
}
