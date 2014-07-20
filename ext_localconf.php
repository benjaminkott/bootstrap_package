<?php
if(!defined('TYPO3_MODE')){
    die('Access denied.');
}


/***************
 * Make the extension configuration accessible
 */
if(!is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY])){
    $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY] = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);
}


/***************
 * Default TsConfig
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:'.$_EXTKEY.'/Configuration/PageTS/mod_wizards.txt">');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:'.$_EXTKEY.'/Configuration/PageTS/tsconfig.txt">');


/***************
 * Configure Themes Constant Editor
 */
if(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('themes')) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:'.$_EXTKEY.'/Configuration/PageTS/mod_themes.txt">');
}


/***************
 * Disable the backend skin if ext:themes is loaded and loading of the backend skin is not forced
 */
if(!\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('themes') || $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['AlwaysEnableBackendSkin']) {

    /***************
     * Backend Styling
     */
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Backend\\View\\LogoView']['className'] = 'BK2K\\BootstrapPackage\\Xclass\\Backend\\View\\LogoView';
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/backend.php']['renderPreProcess'][] = 'BK2K\\BootstrapPackage\\Hooks\\Backend\\RenderPreProcess->addStyles';
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/template.php']['preHeaderRenderHook'][] = 'BK2K\\BootstrapPackage\\Hooks\\Backend\\PreHeaderRender->addStyles';

}


/***************
 * Use RealUrl Config from Bootstrap Package
 */
if($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['UseRealUrlConfig'] == 1){
    @include_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY,'Configuration/RealURL/Default.php'));
}


if (TYPO3_MODE === 'BE') {

    /**
     * Provides an example .htaccess file for Apache after extension is installed and shows a warning if TYPO3 is not running on Apache.
     */
    $signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\SignalSlot\\Dispatcher');
    $signalSlotDispatcher->connect(
        'TYPO3\\CMS\\Extensionmanager\\Service\\ExtensionManagementService',
        'hasInstalledExtensions',
        'BK2K\\BootstrapPackage\\Service\\InstallService',
        'generateApacheHtaccess'
    );

}


/***************
 * Reset extConf array to avoid errors
 */
if(is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY])){
    $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY] = serialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);
}


/***************
 * Register hook for processing less files
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][] = 'BK2K\\BootstrapPackage\\Hooks\\PageRendererRender\\PreProcessHook->execute';
