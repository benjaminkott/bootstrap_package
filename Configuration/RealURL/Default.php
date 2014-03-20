<?php

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl'] = array (
    '_DEFAULT' => array (
        'init' => array (
            'enableCHashCache' => '1',
            'appendMissingSlash' => 'ifNotFile',
            'enableUrlDecodeCache' => '1',
            'enableUrlEncodeCache' => '1',
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
        'pagePath' => array (
            'type' => 'user',
            'userFunc' => 'EXT:realurl/class.tx_realurl_advanced.php:&tx_realurl_advanced->main',
            'spaceCharacter' => '-',
            'languageGetVar' => 'L',
            'expireDays' => '7',
            'rootpage_id' => '1',
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
            'index' => array (
                'rss.xml' => array (
                    'keyValues' => array (
                        'type' => '100',
                    ),
                ),
                'rss091.xml' => array (
                    'keyValues' => array (
                        'type' => '101',
                    ),
                ),
                'rdf.xml' => array (
                    'keyValues' => array (
                        'type' => '102',
                    ),
                ),
                'atom.xml' => array (
                    'keyValues' => array (
                        'type' => '103',
                    ),
                ),
            ),
        ),
    )
);