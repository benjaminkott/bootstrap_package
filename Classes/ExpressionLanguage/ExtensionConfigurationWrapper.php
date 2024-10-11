<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ExpressionLanguage;

use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;

#[Autoconfigure(public: true)]
final class ExtensionConfigurationWrapper
{
    public function __construct(
        private readonly ExtensionConfiguration $extensionConfiguration,
    ) {
    }

    /**
     * True if a bool toggle in ext_conf_template is true'ish.
     */
    public function isToggleEnabled(string $extensionKey, string $extConfTemplateToggle): bool
    {
        return (bool)$this->extensionConfiguration->get($extensionKey, $extConfTemplateToggle);
    }
}
