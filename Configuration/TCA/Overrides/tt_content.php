<?php
defined('TYPO3_MODE') || die();

/***************
 * Add content element group to seletor list
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:theme_name',
        '--div--'
    ],
    '--div--',
    'before'
);

/***************
 * Make tt_content categorizable
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
    'bootstrap_package',
    'tt_content',
    'categories',
    [],
    true
);
