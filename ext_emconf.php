<?php

/************************************************************************
 * Extension Manager/Repository config file for ext "bootstrap_package".
 ************************************************************************/
$EM_CONF[$_EXTKEY] = [
    'title' => 'Bootstrap Package',
    'description' => 'Bootstrap Package delivers a full configured frontend theme for TYPO3, based on the Bootstrap CSS Framework.',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-9.0.99',
            'rte_ckeditor' => '8.7.0-9.0.99'
        ],
        'conflicts' => [
            'css_styled_content' => '*',
            'fluid_styled_content' => '*',
            'themes' => '*',
            'fluidpages' => '*',
            'dyncss' => '*',
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'BK2K\\BootstrapPackage\\' => 'Classes'
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Benjamin Kott',
    'author_email' => 'info@bk2k.info',
    'author_company' => 'private',
    'version' => '8.0.5',
];
