<?php

/***************
 * Modify the pages TCA
 */
$tca = array(
	'columns' => array(
		'ogtitle' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:pages.ogtitle',
			'config'  => array(
                                'type' => 'input',
                                'size' => 120,
                                'max'  => 120,
                                'eval' => 'trim',
                        )
		),
		'ogdescription' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:pages.ogdescription',
			'config'  => array(
                                'type' => 'text',
                                'cols' => 40,
                                'rows' => 10,
                                'eval' => 'trim',
                        )
		),
        ),
);
$GLOBALS['TCA']['pages'] = array_replace_recursive($GLOBALS['TCA']['pages'], $tca);


/***************
 * Add fields before keywords
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'pages',
        'ogtitle, ogdescription',
        1,
        'before:keywords'
);