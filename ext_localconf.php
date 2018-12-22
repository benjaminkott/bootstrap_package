<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') || die();

/***************
 * Define TypoScript as content rendering template
 */
$GLOBALS['TYPO3_CONF_VARS']['FE']['contentRenderingTemplates'][] = 'bootstrappackage/Configuration/TypoScript/';
$GLOBALS['TYPO3_CONF_VARS']['FE']['contentRenderingTemplates'][] = 'bootstrappackage/Configuration/TypoScript/ContentElement/';

/***************
 * Make the extension configuration accessible
 */
if (class_exists(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)) {
    $extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
    );
    $bootstrapPackageConfiguration = $extensionConfiguration->get('bootstrap_package');
} else {
    // Fallback for CMS8
    // @extensionScannerIgnoreLine
    $bootstrapPackageConfiguration = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['bootstrap_package'];
    if (!is_array($bootstrapPackageConfiguration)) {
        $bootstrapPackageConfiguration = unserialize($bootstrapPackageConfiguration);
    }
}

/***************
 * PageTS
 */

// Add Content Elements
if (!$bootstrapPackageConfiguration['disablePageTsContentElements']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TsConfig/Page/ContentElement/All.tsconfig">');
}

// Add BackendLayouts for the BackendLayout DataProvider
if (!$bootstrapPackageConfiguration['disablePageTsBackendLayouts']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TsConfig/Page/Mod/WebLayout/BackendLayouts.tsconfig">');
}

// RTE
if (!$bootstrapPackageConfiguration['disablePageTsRTE']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TsConfig/Page/RTE.tsconfig">');
}

// TCEMAIN
if (!$bootstrapPackageConfiguration['disablePageTsTCEMAIN']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TsConfig/Page/TCEMAIN.tsconfig">');
}

// TCEFORM
if (!$bootstrapPackageConfiguration['disablePageTsTCEFORM']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TsConfig/Page/TCEFORM.tsconfig">');
}

/***************
 * Register custom EXT:form configuration
 */
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

if (TYPO3_MODE === 'BE') {
    $signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);

    /**
     * Provide example webserver configuration after extension is installed.
     */
    $signalSlotDispatcher->connect(
        \TYPO3\CMS\Extensionmanager\Service\ExtensionManagementService::class,
        'hasInstalledExtensions',
        \BK2K\BootstrapPackage\Service\InstallService::class,
        'generateApacheHtaccess'
    );

    /**
     * Add backend styling
     */
    $signalSlotDispatcher->connect(
        \TYPO3\CMS\Extensionmanager\Service\ExtensionManagementService::class,
        'hasInstalledExtensions',
        \BK2K\BootstrapPackage\Service\BrandingService::class,
        'setBackendStyling'
    );

    /**
     * Add current Bootstrap Package version to system information toolbar
     */
    $signalSlotDispatcher->connect(
        \TYPO3\CMS\Backend\Backend\ToolbarItems\SystemInformationToolbarItem::class,
        'getSystemInformation',
        \BK2K\BootstrapPackage\Backend\ToolbarItem\VersionToolbarItem::class,
        'addVersionInformation'
    );
}

/***************
 * Register google font hook
 */
if (!$bootstrapPackageConfiguration['disableGoogleFontCaching']) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][\BK2K\BootstrapPackage\Hooks\PageRenderer\GoogleFontHook::class]
        = \BK2K\BootstrapPackage\Hooks\PageRenderer\GoogleFontHook::class . '->execute';
}

/***************
 * Register css processing parser
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/bootstrap-package/css']['parser'][\BK2K\BootstrapPackage\Parser\ScssParser::class] =
    \BK2K\BootstrapPackage\Parser\ScssParser::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/bootstrap-package/css']['parser'][\BK2K\BootstrapPackage\Parser\LessParser::class] =
    \BK2K\BootstrapPackage\Parser\LessParser::class;

/***************
 * Register css processing hooks
 */
if (!$bootstrapPackageConfiguration['disableCssProcessing'] || !$bootstrapPackageConfiguration['disableLessProcessing']) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][\BK2K\BootstrapPackage\Hooks\PageRenderer\PreProcessHook::class]
        = \BK2K\BootstrapPackage\Hooks\PageRenderer\PreProcessHook::class . '->execute';
}

/***************
 * Register font loader
 */
if (!$bootstrapPackageConfiguration['disableFontLoader']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants(implode(LF, [
        '# customsubcategory=98=Preloader',
        'page.preloader {',
        '    # cat=bootstrap package: preloader/98/1_enable; type=boolean; label=Preloader: Enable to display the preloader',
        '    enable = 1',
        '    logo {',
        '        # cat=bootstrap package: preloader/98/2_logo_file; type=string; label=Logo: Leave blank to don´t show a logo',
        '        file = EXT:bootstrap_package/Resources/Public/Images/BootstrapPackageInverted.svg',
        '        # cat=bootstrap package: preloader/98/3_logo_height; type=int+; label=Height: The image will not be resized!',
        '        height = 52',
        '        # cat=bootstrap package: preloader/98/4_logo_width; type=int+; label=Width: The image will not be resized!',
        '        width = 180',
        '    }',
        '    # cat=bootstrap package: preloader/98/5_background_color; type=color; label=Background Color',
        '    backgroundColor = #333333',
        '    # cat=bootstrap package: preloader/98/6_fade_duration; type=string; label=Fade duration',
        '    fadeDuration = 0.25',
        '}'
    ]));
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][\BK2K\BootstrapPackage\Hooks\PageRenderer\FontLoaderHook::class]
        = \BK2K\BootstrapPackage\Hooks\PageRenderer\FontLoaderHook::class . '->execute';
}

/***************
 * Add default RTE configuration for bootstrap package
 */
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['bootstrap'] = 'EXT:bootstrap_package/Configuration/RTE/Default.yaml';

/***************
 * Extend TYPO3 upgrade wizards to handle boostrap package specific upgrades
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\TYPO3\CMS\Install\Updates\SectionFrameToFrameClassUpdate::class]
    = \BK2K\BootstrapPackage\Updates\SectionFrameToFrameClassUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\TableContentElementUpdate::class]
    = \BK2K\BootstrapPackage\Updates\TableContentElementUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\PanelContentElementUpdate::class]
    = \BK2K\BootstrapPackage\Updates\PanelContentElementUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\TexticonContentElement::class]
    = \BK2K\BootstrapPackage\Updates\TexticonContentElement::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\TexticonSizeUpdate::class]
    = \BK2K\BootstrapPackage\Updates\TexticonSizeUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\TexticonTypeUpdate::class]
    = \BK2K\BootstrapPackage\Updates\TexticonTypeUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\TexticonIconUpdate::class]
    = \BK2K\BootstrapPackage\Updates\TexticonIconUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\ListGroupContentElement::class]
    = \BK2K\BootstrapPackage\Updates\ListGroupContentElement::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\ExternalMediaContentElement::class]
    = \BK2K\BootstrapPackage\Updates\ExternalMediaContentElement::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\BulletContentElementUpdate::class]
    = \BK2K\BootstrapPackage\Updates\BulletContentElementUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\TabContentElementUpdate::class]
    = \BK2K\BootstrapPackage\Updates\TabContentElementUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\AccordionContentElementUpdate::class]
    = \BK2K\BootstrapPackage\Updates\AccordionContentElementUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\AccordionMediaOrientUpdate::class]
    = \BK2K\BootstrapPackage\Updates\AccordionMediaOrientUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\TabMediaOrientUpdate::class]
    = \BK2K\BootstrapPackage\Updates\TabMediaOrientUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\CarouselContentElementUpdate::class]
    = \BK2K\BootstrapPackage\Updates\CarouselContentElementUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\CarouselItemTypeUpdate::class]
    = \BK2K\BootstrapPackage\Updates\CarouselItemTypeUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\BackendLayoutUpdate::class]
    = \BK2K\BootstrapPackage\Updates\BackendLayoutUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\FrameClassToBackgroundUpdate::class]
    = \BK2K\BootstrapPackage\Updates\FrameClassToBackgroundUpdate::class;

/***************
 * Register "bk2k" as global fluid namespace
 */
$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['bk2k'][] = 'BK2K\\BootstrapPackage\\ViewHelpers';

/***************
 * Register Icons
 */
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon(
    'systeminformation-bootstrappackage',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/SystemInformation/bootstrappackage.svg']
);
$icons = [
    'accordion',
    'accordion-item',
    'card-group',
    'card-group-item',
    'carousel',
    'carousel-item',
    'carousel-item-backgroundimage',
    'carousel-item-calltoaction',
    'carousel-item-header',
    'carousel-item-html',
    'carousel-item-image',
    'carousel-item-textandimage',
    'beside-text-img-centered-left',
    'beside-text-img-centered-right',
    'csv',
    'externalmedia',
    'icon-group',
    'icon-group-item',
    'listgroup',
    'menu-card',
    'social-links',
    'tab',
    'tab-item',
    'texticon',
    'timeline',
    'timeline-item'
];
foreach ($icons as $icon) {
    $iconRegistry->registerIcon(
        'content-bootstrappackage-' . $icon,
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/' . $icon . '.svg']
    );
}

/***************
 * Backend Styling for CMS8
 * Please see \BK2K\BootstrapPackage\Service\BrandingService for CMS9
 */
if (TYPO3_MODE === 'BE' && !class_exists(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)) {
    // @extensionScannerIgnoreLine
    $backendConfiguration = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend'];
    if (!is_array($backendConfiguration)) {
        $backendConfiguration = unserialize($backendConfiguration);
    }
    // Login Logo
    if (!isset($backendConfiguration['loginLogo']) || empty(trim($backendConfiguration['loginLogo']))) {
        $backendConfiguration['loginLogo'] = 'EXT:bootstrap_package/Resources/Public/Images/Backend/login-logo.svg';
    }
    // Login Background
    if (!isset($backendConfiguration['loginBackgroundImage']) || empty(trim($backendConfiguration['loginBackgroundImage']))) {
        $backendConfiguration['loginBackgroundImage'] = 'EXT:bootstrap_package/Resources/Public/Images/Backend/login-background-image.jpg';
    }
    // Backend Logo
    if (!isset($backendConfiguration['backendLogo']) || empty(trim($backendConfiguration['backendLogo']))) {
        $backendConfiguration['backendLogo'] = 'EXT:bootstrap_package/Resources/Public/Images/Backend/backend-logo.svg';
    }
    $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend'] = serialize($backendConfiguration);
}

/***
 * Automatic Language Menus
 * Compatibility for CMS 8.7
 */
if (!class_exists(\TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor::class)) {
    // SignalSlot dispatcher
    $signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);
    // Register slot to build TCA for content elements
    $signalSlotDispatcher->connect(
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::class,
        'tcaIsBeingBuilt',
        \BK2K\BootstrapPackage\Slot\LanguageMenuSlot::class,
        'addTcaFields'
    );
    // Set alias for language menu processor as polyfill functionality for older TYPO3 versions
    class_alias(
        \BK2K\BootstrapPackage\DataProcessing\LanguageMenuProcessor::class,
        \TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor::class
    );
    // Register hook to dynamically add language config conditions to the TypoScript Setup
    TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants(implode(LF, [
        '# customsubcategory=99=Language',
        'config.language.default {',
        '    # cat=bootstrap package: language/99/10; type=boolean; label=Enable Default Language: If not checked the default language will not be rendered',
        '    enable = 1',
        '    # cat=bootstrap package: language/99/20; type=string; label=Default Title: Title of the default language',
        '    title = English',
        '    # cat=bootstrap package: language/99/30; type=string; label=Default Navigation Title: Navigation title (e.g. "English", "Deutsch", "Français")',
        '    nav_title = English',
        '    # cat=bootstrap package: language/99/40; type=string; label=Default Locale: Language locale should be something like de_DE or en_US.UTF-8',
        '    locale = en_US.UTF-8',
        '    # cat=bootstrap package: language/99/50; type=string; label=Default two letter ISO code: Two letter ISO code of the default language (e.g. en)',
        '    language_isocode = en',
        '    # cat=bootstrap package: language/99/60; type=string; label=Default Language tag: Language tag defined by RFC 1766 / 3066 for "lang" and "hreflang" attributes (e.g. en-US)',
        '    hreflang = en-US',
        '    # cat=bootstrap package: language/99/70; type=options[Left to Right=ltr, Right to Left=rtl]; label=Default Language Direction: Language direction for "dir" attribute',
        '    direction = ltr',
        '}'
    ]));
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['Core/TypoScript/TemplateService']['runThroughTemplatesPostProcessing'][\BK2K\BootstrapPackage\Hooks\Frontend\TypoScriptLanguageHook::class]
        = \BK2K\BootstrapPackage\Hooks\Frontend\TypoScriptLanguageHook::class . '->addLanguageSetup';
    // Register formEngine nodes
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1525380017] = [
        'nodeName' => 'AdditionalFieldInformation',
        'priority' => '70',
        'class' => \BK2K\BootstrapPackage\Form\FieldInformation\AdditionalFieldInformation::class
    ];
}
