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
if (!is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY])) {
    $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY] = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);
}

/***************
 * PageTS
 */

// Add Bootstrap Content Elements to newContentElement Wizard
if (!$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['disablePageTsNewContentElementWizard']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/Mod/Wizards/newContentElement.txt">');
}

// Add Previews for Bootstrap Content Elements
if (!$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['disablePageTsTtContentPreviews']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/Mod/WebLayout/TtContent/preview.txt">');
}

// Add BackendLayouts BackendLayouts for the BackendLayout DataProvider
if (!$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['disablePageTsBackendLayouts']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/Mod/WebLayout/BackendLayouts.txt">');
}

// RTE
if (!$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['disablePageTsRTE']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/RTE.txt">');
}

// TCEMAIN
if (!$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['disablePageTsTCEMAIN']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/TCEMAIN.txt">');
}

// TCEFORM
if (!$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['disablePageTsTCEFORM']) {
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
 * Register hook for processing less files
 */
if (!$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['disableLessProcessing']) {
    if (TYPO3_MODE === 'FE') {
        require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('bootstrap_package') . '/Contrib/less.php/Less.php');
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][] = 'BK2K\\BootstrapPackage\\Hooks\\PageRenderer\\PreProcessHook->execute';
    }
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearCachePostProc'][] = 'BK2K\\BootstrapPackage\\Hooks\\TceMain\\ClearCacheHook->clearLessCache';
}

/***************
 * Reset extConf array to avoid errors
 */
if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY])) {
    $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY] = serialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);
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
    'content-bootstrappackage-listgroup',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/listgroup.svg']
);
$iconRegistry->registerIcon(
    'systeminformation-bootstrappackage',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/SystemInformation/bootstrappackage.svg']
);
