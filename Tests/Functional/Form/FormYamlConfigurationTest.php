<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\Form;

use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Form\Mvc\Configuration\ConfigurationManagerInterface;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Testcase for the EXT:form configuration this extension ships
 *
 * @see Configuration/Form/BootstrapPackage/config.yaml
 */
final class FormYamlConfigurationTest extends FunctionalTestCase
{
    protected array $coreExtensionsToLoad = [
        'seo',
        'rte_ckeditor',
        'extensionmanager',
        'install',
        'form',
    ];

    protected array $testExtensionsToLoad = [
        'typo3conf/ext/bootstrap_package',
    ];

    #[Test]
    public function formSetIsDiscoveredWithoutTypoScriptRegistration(): void
    {
        if ((new Typo3Version())->getMajorVersion() < 14) {
            self::markTestSkipped('Form YAML auto-discovery was introduced in TYPO3 v14.2');
        }

        // No TypoScript settings are handed over, so anything found here comes
        // from the auto-discovered Configuration/Form/BootstrapPackage/config.yaml.
        $configuration = $this->get(ConfigurationManagerInterface::class)->getYamlConfiguration([], false);

        self::assertContains(
            'EXT:bootstrap_package/Resources/Private/Forms/',
            $configuration['persistenceManager']['allowedExtensionPaths'] ?? []
        );

        $renderingOptions = $configuration['prototypes']['standard']['formElementsDefinition']['Form']['renderingOptions'] ?? [];

        self::assertSame('version2', $renderingOptions['templateVariant'] ?? null);
        self::assertSame(
            'EXT:bootstrap_package/Resources/Private/Templates/Form/',
            $renderingOptions['templateRootPaths'][20] ?? null
        );
        self::assertSame(
            'EXT:bootstrap_package/Resources/Private/Partials/Form/',
            $renderingOptions['partialRootPaths'][20] ?? null
        );
        self::assertSame(
            'EXT:bootstrap_package/Resources/Private/Layouts/Form/',
            $renderingOptions['layoutRootPaths'][20] ?? null
        );
    }

    #[Test]
    public function typoScriptRegistrationIsNotAddedOnSupportingVersions(): void
    {
        if ((new Typo3Version())->getMajorVersion() < 14) {
            self::markTestSkipped('TYPO3 v13.4 has no auto-discovery and still needs the TypoScript registration');
        }

        self::assertStringNotContainsString(
            'yamlConfigurations',
            (string)($GLOBALS['TYPO3_CONF_VARS']['FE']['defaultTypoScript_setup'] ?? '')
        );
    }
}
