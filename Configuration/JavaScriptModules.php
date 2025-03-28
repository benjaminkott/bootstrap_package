<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

return [
    'dependencies' => [
        'core',
        'form',
        'rte_ckeditor',
    ],
    'tags' => [
        'backend.form',
    ],
    'imports' => [
        '@bk2k/bootstrap-package/' => 'EXT:bootstrap_package/Resources/Public/JavaScript/ESM/',
    ],
];
