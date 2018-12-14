<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Service;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * CompileService
 */
class CompileService
{

    /**
     * @param string $file
     * @return bool|string
     * @throws \Exception
     */
    public static function getCompiledFile($file)
    {
        $file = GeneralUtility::getFileAbsFileName($file);
        $pathParts = pathinfo($file);
        if ($pathParts['extension'] === 'less') {
            try {
                $options = [
                    'cache_dir' => GeneralUtility::getFileAbsFileName('typo3temp/bootstrappackage')
                ];
                $settings = ($GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_bootstrappackage.']['settings.'] ?: []);
                if ($settings['cssSourceMapping']) {
                    // enable source mapping
                    $optionsForSourceMap = [
                        'sourceMap' => true,
                        'sourceMapWriteTo' => GeneralUtility::getFileAbsFileName('typo3temp/bootstrappackage') . '/bootstrappackage.map',
                        'sourceMapURL' => '/typo3temp/bootstrappackage/bootstrappackage.map',
                        'sourceMapBasepath' => PATH_site,
                        'sourceMapRootpath' => '/'
                    ];
                    $options += $optionsForSourceMap;

                    // Disable CSS compression
                    /** @var $pageRenderer \TYPO3\CMS\Core\Page\PageRenderer */
                    $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
                    $pageRenderer->disableCompressCss();
                }
                if ($settings['overrideLessVariables']) {
                    $variables = self::getVariablesFromConstants();
                } else {
                    $variables = [];
                }
                $files = [];
                $files[$file] = '../../' . str_replace(PATH_site, '', dirname($file)) . '/';
                $compiledFile = \Less_Cache::Get($files, $options, $variables);
                $file = 'typo3temp/bootstrappackage/' . $compiledFile;

                return $file;
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
        return false;
    }

    /**
     * @return array
     */
    public static function getVariablesFromConstants()
    {
        $variables = [];
        $prefix = 'plugin.bootstrap_package.settings.less.';
        if (!isset($GLOBALS['TSFE']->tmpl->flatSetup) || !is_array($GLOBALS['TSFE']->tmpl->flatSetup) || count($GLOBALS['TSFE']->tmpl->flatSetup) === 0) {
            $GLOBALS['TSFE']->tmpl->generateConfig();
        }
        foreach ($GLOBALS['TSFE']->tmpl->flatSetup as $constant => $value) {
            if (strpos($constant, $prefix) === 0) {
                $variables[substr($constant, strlen($prefix))] = $value;
            }
        }
        return $variables;
    }
}
