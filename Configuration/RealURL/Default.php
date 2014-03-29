<?php

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl'] = array (
    '_DEFAULT' => array (
        'init' => array (
            'enableCHashCache' => TRUE,
            'appendMissingSlash' => 'ifNotFile',
            'enableUrlDecodeCache' => TRUE,
            'enableUrlEncodeCache' => TRUE,
            'emptyUrlReturnValue' => \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_SITE_URL'),
        ),
        'pagePath' => array (
            'type' => 'user',
            'userFunc' => 'EXT:realurl/class.tx_realurl_advanced.php:&tx_realurl_advanced->main',
            'spaceCharacter' => '-',
            'languageGetVar' => 'L',
        ),
        'redirects' => array (
        ),
        'preVars' => array (
            '0' => array (
                'GETvar' => 'no_cache',
                'valueMap' => array (
                    'nc' => '1',
                ),
                'noMatch' => 'bypass'
            ),
            '1' => array (
                'GETvar' => 'L',
                'valueMap' => array (
                    'da' => '1',
                    'de' => '2',
                ),
                'noMatch' => 'bypass',
            ),
        ),
        'fixedPostVars' => array (
        ),
        'postVarSets' => array (
            '_DEFAULT' => array (
                'page' => array(
                    0 => array(
                        'GETvar' => 'page',
                    ),
                ),
            ),
        ),
        'fileName' => array (
            'defaultToHTMLsuffixOnPrev' => true,
        ),
    )
);