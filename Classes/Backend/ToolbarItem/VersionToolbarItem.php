<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Backend\ToolbarItem;

use TYPO3\CMS\Backend\Backend\ToolbarItems\SystemInformationToolbarItem;
use TYPO3\CMS\Core\Utility\CommandUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * VersionToolbarItem
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
        if ($value === null) {
            $value = ExtensionManagementUtility::getExtensionVersion('bootstrap_package');
        }

        // Set system information entry
        $systemInformation->addSystemInformation(
            'Bootstrap Package',
            htmlspecialchars($value, ENT_QUOTES | ENT_HTML5),
            'systeminformation-bootstrappackage'
        );
    }
}
