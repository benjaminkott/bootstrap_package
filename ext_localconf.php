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
 * PageTs
 */

// Add Bootstrap Content Elements to newContentElement Wizard
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/Mod/Wizards/newContentElement.txt">');

// Configure Form Extension
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('form')) {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/Mod/Wizards/form.txt">');
}

// Add BackendLayouts BackendLayouts for the BackendLayout DataProvider
if (!$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['disablePageTsBackendLayouts']) {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/Mod/web_layout.txt">');
}

// AdminPanel
if (!$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['disablePageTsAdmPanel']) {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/admPanel.txt">');
}

// TCEMAIN
if (!$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['disablePageTsTCEMAIN']) {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/TCEMAIN.txt">');
}

// TCEFORM
if (!$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['disablePageTsTCEFORM']) {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/TCEFORM.txt">');
}

// Configure the RTE to match the needs of Bootstrap Package
if (!$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['disablePageTsRTE']) {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/RTE.txt">');
}

// Configure Themes Constant Editor
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('themes')) {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/Mod/tx_themes.txt">');
}


/***************
 * Disable the backend skin if ext:themes is loaded or it is disabled in the extension configuration
 * Override is not nessecary anymore.
 */
if (!\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('themes')
	&& !$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['disableBackendSkin']
	&& (\TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version) < 7000000)
) {

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
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('realurl')
	&& $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['UseRealUrlConfig'] == 1
) {
	@include_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY, 'Configuration/RealURL/Default.php'));
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
if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY])) {
	$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY] = serialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);
}


/***************
 * Register hook for processing less files
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][] = 'BK2K\\BootstrapPackage\\Hooks\\PageRendererRender\\PreProcessHook->execute';
