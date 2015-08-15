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
 * Default TypoScript
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Bootstrap Package');

/***************
 * Bootstrap Package OnePage TypoScript Setup
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript/OnePage', 'Bootstrap Package: OnePage');


/***************
 * Backend Styling
 */
if (TYPO3_MODE == 'BE') {
    if (!isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['Logo'])
        || empty($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['Logo'])
    ) {
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['Logo'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Images/Backend/TopBarLogo@2x.png';
    }
    if (!isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['LoginLogo'])
        || empty($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['LoginLogo'])
    ) {
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['LoginLogo'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Images/Backend/LoginLogo.png';
    }
    if (\TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version) >= 7000000) {
        $pathPrefix = 'bootstrap_package/Resources/Public/Images/Backend/';
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['Logo'] = str_replace($pathPrefix . 'TopBarLogo@2x.png', $pathPrefix . 'TopBarLogo-v7@2x.png', $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['Logo']);
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['LoginLogo'] = str_replace($pathPrefix . 'LoginLogo.png', $pathPrefix . 'LoginLogo-v7.png', $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['LoginLogo']);
        unset($pathPrefix);
    }
    $GLOBALS['TBE_STYLES']['logo'] = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['Logo'];
    $GLOBALS['TBE_STYLES']['logo_login'] = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['LoginLogo'];
}


/***************
 * BackendLayoutDataProvider for versions below 7.4
 */
if (\TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version) < 7004000) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['BackendLayoutDataProvider']['pagets'] = 'BK2K\BootstrapPackage\Hooks\Options\BackendLayoutDataProvider';
}


/***************
 * DataHandler Hook
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][$_EXTKEY] = 'BK2K\BootstrapPackage\Hooks\DataHandler';


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
