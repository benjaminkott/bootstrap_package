<?php
namespace BK2K\BootstrapPackage\Service;

/*
 *  The MIT License (MIT)
 *
 *  Copyright (c) 2014 Benjamin Kott, http://www.bk2k.info
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

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * @author Benjamin Kott <info@bk2k.info>
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
                $options = array(
                    'cache_dir' => GeneralUtility::getFileAbsFileName('typo3temp/bootstrappackage')
                );
                $settings = ($GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_bootstrappackage.']['settings.'] ?: array());
                if ($settings['cssSourceMapping']) {
                    // enable source mapping
                    $optionsForSourceMap = array(
                        'sourceMap' => true,
                        'sourceMapWriteTo' => GeneralUtility::getFileAbsFileName('typo3temp/bootstrappackage') . '/bootstrappackage.map',
                        'sourceMapURL' => '/typo3temp/bootstrappackage/bootstrappackage.map',
                        'sourceMapBasepath' => PATH_site,
                        'sourceMapRootpath' => '/'
                    );
                    $options += $optionsForSourceMap;

                    // disable CSS compression
                    /** @var $pageRenderer \TYPO3\CMS\Core\Page\PageRenderer */
                    $pageRenderer = $GLOBALS['TSFE']->getPageRenderer();
                    $pageRenderer->disableCompressCss();
                }
                if ($settings['overrideLessVariables']) {
                    $variables = self::getVariablesFromConstants();
                } else {
                    $variables = array();
                }
                $files = array();
                $files[$file] = '../../' . str_replace(PATH_site, '', dirname($file)) . '/';
                $compiledFile = \Less_Cache::Get($files, $options, $variables);
                $file = "typo3temp/bootstrappackage/" . $compiledFile;

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
    public function getVariablesFromConstants()
    {
        $variables = array();
        $prefix = "plugin.bootstrap_package.settings.less.";
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
