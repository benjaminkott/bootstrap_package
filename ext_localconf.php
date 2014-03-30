<?php
if(!defined('TYPO3_MODE')){
    die('Access denied.');
}


/***************
 * Default TsConfig
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:'.$_EXTKEY.'/Configuration/PageTS/ModWizards.ts">');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:'.$_EXTKEY.'/Configuration/PageTS/TSConfig.ts">');


/***************
 * Backend Styling
 */
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Backend\\View\\LogoView']['className'] = 'BK2K\\BootstrapPackage\\Xclass\\Backend\\View\\LogoView';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/backend.php']['renderPreProcess'][] = 'BK2K\\BootstrapPackage\\Hooks\\Backend\\RenderPreProcess->addStyles';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/template.php']['preHeaderRenderHook'][] = 'BK2K\\BootstrapPackage\\Hooks\\Backend\\PreHeaderRender->addStyles';


/***************
 * Use RealUrl Config from Bootstrap Package
 */
$settings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);
if($settings['UseRealUrlConfig'] == 1){
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