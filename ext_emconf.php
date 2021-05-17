<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

$EM_CONF[$_EXTKEY] = [
    'title' => 'Bootstrap Package',
    'description' => 'Bootstrap Package delivers a full configured frontend theme for TYPO3, based on the Bootstrap CSS Framework.',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-11.2.99',
            'rte_ckeditor' => '10.4.0-11.2.99',
            'seo' => '10.4.0-11.2.99'
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
    'version' => '12.0.0-dev',
];
