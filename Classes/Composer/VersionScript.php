<?php
namespace BK2K\BootstrapPackage\Composer;

/*
 *  The MIT License (MIT)
 *
 *  Copyright (c) 2015 Benjamin Kott, http://www.bk2k.info
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in
 *  all copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *  THE SOFTWARE.
 */

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
        file_put_contents($file, $content);
        echo "- $file was set to version $version" . PHP_EOL;

        // Documentation/Settings.yml
        $file = realpath($rootFolder . 'Documentation/Settings.yml');
        $content = file_get_contents($file);
        $content = preg_replace('/(version|release): \d+\.\d+\.\d+/', '$1: ' . $version, $content);
        file_put_contents($file, $content);
        echo "- $file was set to version $version" . PHP_EOL;

        // JavaScript Files
        $folder = realpath($rootFolder . 'Resources/Public/JavaScript/Dist/');
        if ($handle = opendir($folder)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != '.' && $entry != '..' && pathinfo($entry, PATHINFO_EXTENSION) === 'js') {
                    $file = realpath($folder . '/' . $entry);
                    $content = file_get_contents($file);
                    $content = preg_replace('/(Bootstrap Package )v\d+\.\d+\.\d+/', '$1v' . $version, $content);
                    file_put_contents($file, $content);
                    echo "- $file was set to version $version" . PHP_EOL;
                }
            }
            closedir($handle);
        }

        // ext_emconf.php
        $file = realpath($rootFolder . 'ext_emconf.php');
        $content = file_get_contents($file);
        $content = preg_replace('/(\'version\' => )\'\d+\.\d+\.\d+/', '$1\'' . $version, $content);
        file_put_contents($file, $content);
        echo "- $file was set to version $version" . PHP_EOL;
    }
}
