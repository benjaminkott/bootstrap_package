<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ExpressionLanguage;

use TYPO3\CMS\Core\ExpressionLanguage\AbstractProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * ConditionProvider
 */
class ConditionProvider extends AbstractProvider
{
    public function __construct()
    {
        $this->expressionLanguageVariables = [
            'extension' => GeneralUtility::makeInstance(ExtensionWrapper::class)
        ];
    }
}
