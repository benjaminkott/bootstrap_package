<?php


declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

require __DIR__ . '/bootstrap.php';
require __DIR__ . '/Seeder.php';
require __DIR__ . '/Loader.php';

$seeder = new Seeder();
(new Loader($seeder))->load(__DIR__ . '/pages');
$seeder->run();

file_put_contents(__DIR__ . '/../../var/demo-content-ids.json', json_encode($seeder->ids(), JSON_PRETTY_PRINT));
echo 'root page uid: ' . $seeder->id('root') . "\n";
