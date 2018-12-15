<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Composer;

use Composer\Script\Event as ScriptEvent;

/**
 * VersionScript
 */
class VersionScript
{
    /**
     * @param ScriptEvent $event
     * @throws \RuntimeException
     */
    public static function setVersion(ScriptEvent $event)
    {
        // Validate Arguments
        $arguments = $event->getArguments();
        if (count($arguments) === 0) {
            throw new \RuntimeException('No arguments provided. Example: composer run-script set-version 1.0.0', 1496141893);
        }
        if (!preg_match('/\A\d+\.\d+\.\d+\z/', $arguments[0])) {
            throw new \RuntimeException('No valid version number provided! Example: composer run-script set-version 1.0.0', 1496141893);
        }
        $version = $arguments[0];

        $rootFolder = __DIR__ . '/../../';

        // Build/package.json
        $file = realpath($rootFolder . 'Build/package.json');
        $content = file_get_contents($file);
        $content = preg_replace('/(\"version\": )\"\d+\.\d+\.\d+/', '$1"' . $version, $content);
        file_put_contents($file, $content, LOCK_EX);
        echo "- $file was set to version $version" . PHP_EOL;

        // Documentation/Settings.yml
        $file = realpath($rootFolder . 'Documentation/Settings.yml');
        $content = file_get_contents($file);
        $content = preg_replace('/(version|release): \d+\.\d+\.\d+/', '$1: ' . $version, $content);
        file_put_contents($file, $content, LOCK_EX);
        echo "- $file was set to version $version" . PHP_EOL;

        // ext_emconf.php
        $file = realpath($rootFolder . 'ext_emconf.php');
        $content = file_get_contents($file);
        $content = preg_replace('/(\'version\' => )\'\d+\.\d+\.\d+/', '$1\'' . $version, $content);
        file_put_contents($file, $content, LOCK_EX);
        echo "- $file was set to version $version" . PHP_EOL;
    }
}
