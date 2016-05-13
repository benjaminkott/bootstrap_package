<?php

/************************************************************************
 * Extension Manager/Repository config file for ext "bootstrap_package".
 ************************************************************************/
$EM_CONF[$_EXTKEY] = array(
    'title' => 'Bootstrap Package',
    'description' => 'Bootstrap Package delivers a full configured frontend theme for TYPO3, based on the Bootstrap CSS Framework.',
    'category' => 'templates',
    'constraints' => array(
        'depends' => array(
            'typo3' => '7.6.2-8.99.99'
        ),
        'conflicts' => array(
            'css_styled_content' => '*',
            'fluid_styled_content' => '*',
            'themes' => '*',
            'fluidpages' => '*',
            'dyncss' => '*',
        ),
    ),
    'autoload' => array(
        'psr-4' => array(
            'BK2K\\BootstrapPackage\\' => 'Classes'
        ),
    ),
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Benjamin Kott',
    'author_email' => 'info@bk2k.info',
    'author_company' => 'private',
    'version' => '7.0.3',
);
