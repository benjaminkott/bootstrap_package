<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

// Define TypoScript as content rendering template
$GLOBALS['TYPO3_CONF_VARS']['FE']['contentRenderingTemplates'][] = 'bootstrappackage/Configuration/TypoScript/';
$GLOBALS['TYPO3_CONF_VARS']['FE']['contentRenderingTemplates'][] = 'bootstrappackage/Configuration/TypoScript/ContentElement/';

// Make the extension configuration accessible
$extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
    \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
);

// Register custom EXT:form configuration
// TYPO3 v14.2 and above discover Configuration/Form/BootstrapPackage/config.yaml
// on their own, and the TypoScript registration below raises a deprecation there.
// @deprecated Drop together with TYPO3 v13 support.
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('form')
    && (new \TYPO3\CMS\Core\Information\Typo3Version())->getMajorVersion() < 14
) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(trim('
        module.tx_form {
            settings {
                yamlConfigurations {
                    110 = EXT:bootstrap_package/Configuration/Form/Setup.yaml
                }
            }
        }
        plugin.tx_form {
            settings {
                yamlConfigurations {
                    110 = EXT:bootstrap_package/Configuration/Form/Setup.yaml
                }
            }
        }
    '));
}

// Register google font hook
if (!(bool) $extensionConfiguration->get('bootstrap_package', 'disableGoogleFontCaching')) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][\BK2K\BootstrapPackage\Hooks\PageRenderer\GoogleFontHook::class]
        = \BK2K\BootstrapPackage\Hooks\PageRenderer\GoogleFontHook::class . '->execute';
}

// Register css processing parser
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/bootstrap-package/css']['parser'][\BK2K\BootstrapPackage\Parser\ScssParser::class] =
    \BK2K\BootstrapPackage\Parser\ScssParser::class;

// Register css processing hooks
if (!(bool) $extensionConfiguration->get('bootstrap_package', 'disableCssProcessing')) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][\BK2K\BootstrapPackage\Hooks\PageRenderer\PreProcessHook::class]
        = \BK2K\BootstrapPackage\Hooks\PageRenderer\PreProcessHook::class . '->execute';
}

// Add default RTE configuration for bootstrap package
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['bootstrap'] = 'EXT:bootstrap_package/Configuration/RTE/Default.yaml';

// Register "bk2k" as global fluid namespace
// TYPO3 v14.1 and above read the namespace from Configuration/Fluid/Namespaces.php
// and stop evaluating TYPO3_CONF_VARS for it in TYPO3 v15.0.
// @deprecated Drop together with TYPO3 v13 support.
if ((new \TYPO3\CMS\Core\Information\Typo3Version())->getMajorVersion() < 14) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['bk2k'][] = 'BK2K\\BootstrapPackage\\ViewHelpers';
}

// Register "icon" wizard
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1687516916] = [
    'nodeName' => 'iconWizard',
    'priority' => 40,
    'class' => \BK2K\BootstrapPackage\Form\FieldWizard\IconWizard::class,
];

// SiteCreator
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = \BK2K\BootstrapPackage\SiteCreator\Hooks\SiteCreatorHook::class;
