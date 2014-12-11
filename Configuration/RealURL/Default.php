<?php

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['init']['enableCHashCache'] = TRUE;
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['init']['appendMissingSlash'] = 'ifNotFile';
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['init']['enableUrlDecodeCache'] = TRUE;
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['init']['enableUrlEncodeCache'] = TRUE;
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['init']['emptyUrlReturnValue'] = \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_SITE_URL');

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['pagePath']['type'] = 'user';
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['pagePath']['userFunc'] = 'EXT:realurl/class.tx_realurl_advanced.php:&tx_realurl_advanced->main';
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['pagePath']['spaceCharacter'] = '-';
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['pagePath']['languageGetVar'] = 'L';

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['preVars'] = array(
	'0' => array(
			'GETvar' => 'no_cache',
			'valueMap' => array(
					'nc' => '1',
			),
			'noMatch' => 'bypass'
	),
	'1' => array(
			'GETvar' => 'L',
			'valueMap' => array(
					'da' => '1',
					'de' => '2',
			),
			'noMatch' => 'bypass',
	),
);

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['postVarSets']['_DEFAULT']['page'] = array(
	0 => array(
			'GETvar' => 'page',
	),
);

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['fileName']['defaultToHTMLsuffixOnPrev'] = TRUE;
