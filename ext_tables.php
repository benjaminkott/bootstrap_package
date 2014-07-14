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
 * Let ext:themes the inclusion of the needed static files handle if loaded
 */
if(!\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('themes')) {

    /***************
     * Default TypoScript
     */
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Bootstrap Package');

}


/***************
 * Disable the backend skin if ext:themes is loaded and loading of the backend skin is not forced
 */
if(!\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('themes') || $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['AlwaysEnableBackendSkin']) {

    /***************
     * Backend Styling
     */
    if (TYPO3_MODE == 'BE') {
        if(!isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['Logo'])){
            $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['Logo'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Images/Backend/TopBarLogo@2x.png';
        }
        if(!isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['LoginLogo'])){
            $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['LoginLogo'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Images/Backend/LoginLogo.png';
        }
        $GLOBALS['TBE_STYLES']['logo'] = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['Logo'];
        $GLOBALS['TBE_STYLES']['logo_login'] = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]['LoginLogo'];
        $GLOBALS['TBE_STYLES']['htmlTemplates']['EXT:backend/Resources/Private/Templates/login.html'] = 'EXT:bootstrap_package/Resources/Private/Templates/Backend/Login.html';
    }

}


/***************
 * BackendLayoutDataProvider
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['BackendLayoutDataProvider'][$_EXTKEY] = 'BK2K\BootstrapPackage\Hooks\Options\BackendLayoutDataProvider';


/***************
 * DataHandler Hook
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][$_EXTKEY] = 'BK2K\BootstrapPackage\Hooks\DataHandler';


/***************
 * Allow Carousel Item & Accordion Item on Standart Pages
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bootstrappackage_carousel_item');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bootstrappackage_accordion_item');


/***************
 * Backend Module
 */
if (TYPO3_MODE === 'BE' && !(TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_INSTALL)) {

    $mainModuleName = 'bootstrappackage';

    /***************
     * Register Main Module
     */
    if (!isset($TBE_MODULES[$mainModuleName])) {
        $temp_TBE_MODULES = array();
        foreach ($TBE_MODULES as $key => $val) {
            if ($key == 'web') {
                $temp_TBE_MODULES[$key] = $val;
                $temp_TBE_MODULES[$mainModuleName] = '';
            } else {
                $temp_TBE_MODULES[$key] = $val;
            }
        }
        $TBE_MODULES = $temp_TBE_MODULES;
    }
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'BK2K.'.$_EXTKEY,
        $mainModuleName,
        '',
        '',
        array()
    );
    $TBE_MODULES['_configuration'][$mainModuleName]['access'] = 'user,group';
    $TBE_MODULES['_configuration'][$mainModuleName]['icon'] = 'EXT:' . $_EXTKEY . '/Resources/Public/Icons/bootstrap_package_module_style.gif';
    $TBE_MODULES['_configuration'][$mainModuleName]['labels'] = 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/MainModule.xlf';

    /***************
     * Register Settings Backend Module
     */
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'BK2K.'.$_EXTKEY,
        $mainModuleName,
        'SettingsStyle',
        '',
        array(
            'SettingsStyle' => 'settings,save',
        ),
        array(
            'access' => 'user,group',
            'icon' => 'EXT:' . $_EXTKEY . '/Resources/Public/Icons/bootstrap_package_module_style.gif',
            'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/ModSettings.xlf',
        )
    );

    /***************
     * Backend Forms Style
     */
    $TCA['__bootstrappackage_form_style'] = array(
        'ctrl' => array(
            'title' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/ThemeSettings.xlf:theme.settings.style',
            'hideTable' => true,
            'canNotCollapse' => true,
            'dividers2tabs' => true,
            'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/Forms/SettingsStyle.php',
            'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'ext_icon.gif'
        ),
    );

}


/***************
 * Reset extConf array to avoid errors
 */
if(is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY])){
    $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY] = serialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);
}