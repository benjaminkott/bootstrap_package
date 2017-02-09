<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

/***************
 * Make the extension configuration accessible
 */
if (!is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY])) {
    $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY] = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);
}

/***************
 * Backend Styling
 */
if (TYPO3_MODE == 'BE') {
    /**
     * Configure TBE_STYLES (TYPO3 = 7)
     */
    if (!isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['Logo'])
        || empty($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['Logo'])
    ) {
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['Logo'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Images/Backend/TopBarLogo@2x.png';
    }
    $GLOBALS['TBE_STYLES']['logo'] = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['Logo'];

    /**
     * Configure Backend Extension
     */
    if (!is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend'])) {
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend'] = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend']);
    }
    // Login Logo (TYPO3 >= 7)
    if (!isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend']['loginLogo'])
        || empty(trim($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend']['loginLogo']))
    ) {
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend']['loginLogo'] = 'EXT:bootstrap_package/Resources/Public/Images/Backend/LoginLogo.png';
    }
    // Backend Logo (TYPO3 >= 8)
    if (!isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend']['backendLogo'])
        || empty(trim($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend']['backendLogo']))
    ) {
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend']['backendLogo'] = 'EXT:bootstrap_package/Resources/Public/Images/Backend/TopBarLogo@2x.png';
    }
    if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend'])) {
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend'] = serialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend']);
    }
}

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
    'content-bootstrappackage-textcolumn',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/textcolumn.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-textteaser',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/textteaser.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-texticon',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/texticon.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-textmedia',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/textmedia.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-panel',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/panel.svg']
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
    'content-bootstrappackage-audio',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/audio.svg']
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
    'content-bootstrappackage-menu-thumbnail',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/menu-thumbnail.svg']
);
$iconRegistry->registerIcon(
    'content-bootstrappackage-quote',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    ['source' => 'EXT:bootstrap_package/Resources/Public/Icons/ContentElements/quote.svg']
);

/***************
 * Allow Carousel Item & Accordion Item on Standart Pages
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bootstrappackage_carousel_item');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bootstrappackage_accordion_item');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bootstrappackage_tab_item');

/***************
 * Remove new content element wizard registration for indexed_search
 * to override it and use the the extbase version instead
 */
if (TYPO3_MODE === 'BE' && \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('indexed_search')) {
    unset($GLOBALS['TBE_MODULES_EXT']['xMOD_db_new_content_el']['addElClasses']['tx_indexed_search_pi_wizicon']);
}

/***************
 * Reset extConf array to avoid errors
 */
if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY])) {
    $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY] = serialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);
}
