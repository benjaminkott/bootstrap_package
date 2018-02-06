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

/***************
 * Make the extension configuration accessible
 */
if (class_exists('TYPO3\CMS\Core\Configuration\ExtensionConfiguration')) {
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

// Add Bootstrap Content Elements to newContentElement Wizard
if (!$bootstrapPackageConfiguration['disablePageTsNewContentElementWizard']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/Mod/Wizards/newContentElement.txt">');
}

// Add Previews for Bootstrap Content Elements
if (!$bootstrapPackageConfiguration['disablePageTsTtContentPreviews']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/Mod/WebLayout/TtContent/preview.txt">');
}

// Add BackendLayouts BackendLayouts for the BackendLayout DataProvider
if (!$bootstrapPackageConfiguration['disablePageTsBackendLayouts']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/Mod/WebLayout/BackendLayouts.txt">');
}

// RTE
if (!$bootstrapPackageConfiguration['disablePageTsRTE']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/RTE.txt">');
}

// TCEMAIN
if (!$bootstrapPackageConfiguration['disablePageTsTCEMAIN']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/TCEMAIN.txt">');
}

// TCEFORM
if (!$bootstrapPackageConfiguration['disablePageTsTCEFORM']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/TCEFORM.txt">');
}

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
 * Register css processing parser
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/bootstrap-package/css']['parser'][] =
    \BK2K\BootstrapPackage\Parser\ScssParser::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/bootstrap-package/css']['parser'][] =
    \BK2K\BootstrapPackage\Parser\LessParser::class;

/***************
 * Register css processing hooks
 */
if (TYPO3_MODE === 'FE' && (!$bootstrapPackageConfiguration['disableCssProcessing'] || !$bootstrapPackageConfiguration['disableLessProcessing'])) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][]
        = 'BK2K\\BootstrapPackage\\Hooks\\PageRenderer\\PreProcessHook->execute';
}

/***************
 * Register font loader
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][]
    = 'BK2K\\BootstrapPackage\\Hooks\\PageRenderer\\FontLoaderHook->execute';

/***************
 * Register cache hooks to clear bootstrap cache files
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearCachePostProc'][]
    = 'BK2K\\BootstrapPackage\\Hooks\\TceMain\\ClearCacheHook->clearCache';

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
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\CarouselContentElementUpdate::class]
    = \BK2K\BootstrapPackage\Updates\CarouselContentElementUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\CarouselItemTypeUpdate::class]
    = \BK2K\BootstrapPackage\Updates\CarouselItemTypeUpdate::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update'][\BK2K\BootstrapPackage\Updates\BackendLayoutUpdate::class]
    = \BK2K\BootstrapPackage\Updates\BackendLayoutUpdate::class;

/***************
 * Register "bk2k" as global fluid namespace
 */
$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['bk2k'][] = 'BK2K\\BootstrapPackage\\ViewHelpers';

/***************
 * Register Icons
 */
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon(
    'content-bootstrappackage-tab',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/tab.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-tab-item',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/tab-item.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-texticon',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/texticon.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-accordion',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/accordion.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-accordion-item',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/accordion-item.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-carousel',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/carousel.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-carousel-item',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/carousel-item.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-carousel-item-header',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/carousel-item-header.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-carousel-item-image',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/carousel-item-image.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-carousel-item-textandimage',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/carousel-item-textandimage.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-carousel-item-backgroundimage',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/carousel-item-backgroundimage.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-carousel-item-html',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/carousel-item-html.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-externalmedia',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/externalmedia.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-icon-group',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/icon-group.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-icon-group-item',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/icon-group-item.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-listgroup',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/listgroup.svg']
);
$iconRegistry->registerIcon(
    'content-menu-card',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/menu-card.svg']
);
$iconRegistry->registerIcon(
    'systeminformation-bootstrappackage',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/SystemInformation/bootstrappackage.svg']
);

/***************
 * Backend Styling for CMS8
 * Please see \BK2K\BootstrapPackage\Service\BrandingService for CMS9
 */
if (TYPO3_MODE == 'BE' && !class_exists('TYPO3\CMS\Core\Configuration\ExtensionConfiguration')) {
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
