<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Parser;

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
        $cacheIdentifier = $this->getCacheIdentifier($file, $settings);
        $cacheFile = $this->getCacheFile($cacheIdentifier, $settings['cache']['tempDirectory']);
        $cacheFileMeta = $this->getCacheFileMeta($cacheFile);
        $compile = false;

        if (!$this->isCached($file, $settings)
            || $this->needsCompile($cacheFile, $cacheFileMeta, $settings)) {
            $compile = true;
        }

        if ($compile) {
            $result = $this->parseFile($file, $settings);
            GeneralUtility::writeFile(GeneralUtility::getFileAbsFileName($cacheFile), $result['css']);
            GeneralUtility::writeFile(GeneralUtility::getFileAbsFileName($cacheFileMeta), serialize($result['cache']));
            $this->clearPageCaches();
        }

        return $cacheFile;
    }

    /**
     * @param string $file
     * @param array $settings
     * @return array
     */
    protected function parseFile($file, $settings)
    {
        $options = [];
        $options['compress'] = true;
        if ($settings['options']['sourceMap']) {
            $options['compress'] = false;
            $options['sourceMap'] = true;
            $options['sourceMapBasepath'] = realpath($this->getPathSite());
            $options['sourceMapRootpath'] = $settings['cache']['tempDirectoryRelativeToRoot'];
        }

        $parser = new \Less_Parser($options);
        $parser->parseFile(GeneralUtility::getFileAbsFileName($file));
        $parser->ModifyVars($settings['variables']);
        $css = $parser->getCss();

        // Correct relative urls
        $absoluteFilename = GeneralUtility::getFileAbsFileName($file);
        $relativePath = $settings['cache']['tempDirectoryRelativeToRoot'] . dirname(substr($absoluteFilename, strlen($this->getPathSite()))) . '/';
        $search = '%url\s*\(\s*[\\\'"]?(?!(((?:https?:)?\/\/)|(?:data:?:)))([^\\\'")]+)[\\\'"]?\s*\)%';
        $replace = 'url("' . $relativePath . '$3")';
        $css = preg_replace($search, $replace, $css);

        $parsedFiles = [];
        foreach ($parser::AllParsedFiles() as $parsedfile) {
            $parsedFiles[$parsedfile] = filemtime($parsedfile);
        }

        return [
            'css' => $css,
            'cache' => [
                'version' => \Less_Version::version,
                'date' => date('r'),
                'css' => $css,
                'etag' => md5($css),
                'files' => $parsedFiles,
                'variables' => $settings['variables'],
                'sourceMap' => $settings['options']['sourceMap']
            ]
        ];
    }
}
