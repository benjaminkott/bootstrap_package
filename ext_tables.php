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
     * Configure Backend Extension
     */
    if (!is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend'])) {
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend'] = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend']);
    }
    // Login Logo
    if (!isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend']['loginLogo'])
        || empty(trim($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend']['loginLogo']))
    ) {
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend']['loginLogo'] = 'EXT:bootstrap_package/Resources/Public/Images/Backend/login-logo.svg';
    }
    // Login Background
    if (!isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend']['loginBackgroundImage'])
        || empty(trim($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend']['loginBackgroundImage']))
    ) {
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend']['loginBackgroundImage'] = 'EXT:bootstrap_package/Resources/Public/Images/Backend/login-background-image.jpg';
    }
    // Backend Logo
    if (!isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend']['backendLogo'])
        || empty(trim($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend']['backendLogo']))
    ) {
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend']['backendLogo'] = 'EXT:bootstrap_package/Resources/Public/Images/Backend/backend-logo.svg';
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

/***************
 * Allow Carousel Item & Accordion Item on Standart Pages
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bootstrappackage_carousel_item');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bootstrappackage_accordion_item');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bootstrappackage_tab_item');

/***************
 * Reset extConf array to avoid errors
 */
if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY])) {
    $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY] = serialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);
}
