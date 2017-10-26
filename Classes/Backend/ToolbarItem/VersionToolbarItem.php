<?php
namespace BK2K\BootstrapPackage\Backend\ToolbarItem;

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

use TYPO3\CMS\Backend\Backend\ToolbarItems\SystemInformationToolbarItem;
use TYPO3\CMS\Core\Utility\CommandUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * @author Benjamin Kott <info@bk2k.info>
 */
class VersionToolbarItem
{
    /**
     * Called by the system information toolbar signal/slot dispatch.
     *
     * @param SystemInformationToolbarItem $systemInformation
     */
    public function addVersionInformation(SystemInformationToolbarItem $systemInformation)
    {
        $value = null;
        $extensionDirectory = ExtensionManagementUtility::extPath('bootstrap_package');

        // Try to get current version from git
        if (file_exists($extensionDirectory . '.git')) {
            CommandUtility::exec('git --version', $_, $returnCode);
            if ((int)$returnCode === 0) {
                $currentDir = getcwd();
                chdir($extensionDirectory);
                $tag = trim(CommandUtility::exec('git tag -l --points-at HEAD'));
                if ($tag) {
                    $value = $tag;
                } else {
                    $branch = trim(CommandUtility::exec('git rev-parse --abbrev-ref HEAD'));
                    $revision = trim(CommandUtility::exec('git rev-parse --short HEAD'));
                    $value = $branch . ', ' . $revision;
                }
                chdir($currentDir);
            }
        }

        // Fallback to version from extension manager
        if (!$value) {
            $value = ExtensionManagementUtility::getExtensionVersion('bootstrap_package');
        }

        // Set system information entry
        $systemInformation->addSystemInformation(
            htmlspecialchars('Bootstrap Package'),
            htmlspecialchars($value),
            'systeminformation-bootstrappackage'
        );
    }
}
