<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Parser;

use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * LessParser
 */
class LessParser extends AbstractParser
{
    /**
     * Constructor
     */
    public function __construct()
    {
        // @TODO: Think about composer dependency and phar file bundling for TER
        if (!class_exists('Less_Cache', false)) {
            require_once ExtensionManagementUtility::extPath('bootstrap_package') . '/Contrib/less.php/Less.php';
        }
    }

    /**
     * @param string $extension
     * @return bool
     */
    public function supports($extension)
    {
        return $extension === 'less';
    }

    /**
     * @param string $file
     * @param array $settings
     * @return string
     */
    public function compile($file, $settings)
    {
        // Initialize Arguments
        $arguments = [
            'file' => [
                'absolute' => $settings['file']['absolute'],
            ],
            'options' => [
                'compress' => true,
                'cache_dir' => GeneralUtility::getFileAbsFileName($settings['cache']['tempDirectory'])
            ],
            'variables' => $settings['variables'],
        ];
        if ($settings['options']['sourceMap']) {
            // Enable source mapping
            $optionsForSourceMap = [
                'sourceMap' => true,
                'sourceMapWriteTo' => GeneralUtility::getFileAbsFileName($settings['cache']['tempDirectory']) . basename($file) . '.map',
                'sourceMapURL' => '/' . $settings['cache']['tempDirectory'] . basename($file) . '.map',
                'sourceMapBasepath' => realpath(PATH_site),
                'sourceMapRootpath' => '/'
            ];
            $arguments['options'] += $optionsForSourceMap;
            // Disable CSS compression
            /** @var $pageRenderer \TYPO3\CMS\Core\Page\PageRenderer */
            $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
            $pageRenderer->disableCompressCss();
        }

        // Process file
        $files = [];
        $files[$arguments['file']['absolute']] = $settings['cache']['tempDirectoryRelativeToRoot'] . str_replace(PATH_site, '', dirname($arguments['file']['absolute'])) . '/';
        $cacheFile = $this->getPathToCacheFileIfExists($files, $arguments['options'], $arguments['variables']);
        if ($cacheFile !== '') {
            return $settings['cache']['tempDirectory'] . $cacheFile;
        }

        // If the code reach this place, a cache not exist and the CSS must be compiled
        // After the files are created, we clear the page cache.
        $compiledFile = \Less_Cache::Get($files, $arguments['options'], $arguments['variables']);
        $this->clearPageCaches();
        return $settings['cache']['tempDirectory'] . $compiledFile;
    }

    /**
     * This method is an ugly hack to fix the stupid less parser code. The method is private and should be
     * removed as fast as possible with the less parser self.
     * The method implement a missing hasCache method to prevent compile and write files for each request.
     *
     * @param array $lessFiles
     * @param array $options
     * @param array $variables
     * @return bool
     */
    private function getPathToCacheFileIfExists($lessFiles, $options, $variables)
    {
        $lessFiles = (array)$lessFiles;

        //create a file for variables
        if (!empty($variables)) {
            $lessVariables = \Less_Parser::serializeVars($variables);
            $vars_file = $options['cache_dir'] . \Less_Cache::$prefix_vars . sha1($lessVariables) . '.less';

            if (!file_exists($vars_file)) {
                file_put_contents($vars_file, $lessVariables);
            }

            $lessFiles += [$vars_file => '/'];
        }

        // generate name for compiled css file
        $hash = md5(json_encode($lessFiles));
        //save the file list
        $temp = [\Less_Version::cache_version];
        foreach ($lessFiles as $file) {
            if (file_exists($file)) {
                $temp[] = filemtime($file) . "\t" . filesize($file) . "\t" . $file;
            }
        }
        $list_file = $options['cache_dir'] . \Less_Cache::$prefix . $hash . '.list';

        $list = '';
        $cached_name = '';
        try {
            \Less_Cache::ListFiles($list_file, $list, $cached_name);
        } catch (Exception $e) {
            // this happens mainly if no caches exists.
            return '';
        }

        $compiled_name = $cached_name;
        return file_exists($options['cache_dir'] . $compiled_name) ? $compiled_name : '';
    }
}
