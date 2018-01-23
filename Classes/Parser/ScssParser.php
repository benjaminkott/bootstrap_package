<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Parser;

use Leafo\ScssPhp\Compiler;
use Leafo\ScssPhp\Formatter\Crunched;
use Leafo\ScssPhp\Version;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * ScssParser
 */
class ScssParser extends AbstractParser
{
    /**
     * Constructor
     */
    public function __construct()
    {
        if (!class_exists('Leafo\ScssPhp\Version', false)) {
            require_once(ExtensionManagementUtility::extPath('bootstrap_package') . '/Contrib/scssphp/scss.inc.php');
        }
    }

    /**
     * @param string $extension
     * @return bool
     */
    public function supports($extension)
    {
        return $extension === 'scss';
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

        if (!$this->isCached($file, $settings)) {
            $compile = true;
        } elseif ($this->needsCompile($cacheFile, $cacheFileMeta, $settings)) {
            $compile = true;
        }

        if ($compile) {
            $result = $this->parseFile($file, $settings);
            file_put_contents(GeneralUtility::getFileAbsFileName($cacheFile), $result['css']);
            GeneralUtility::fixPermissions($cacheFile);
            file_put_contents(GeneralUtility::getFileAbsFileName($cacheFileMeta), serialize($result['cache']));
            GeneralUtility::fixPermissions($cacheFileMeta);
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
        $scss = new Compiler();
        $scss->setFormatter(Crunched::class);
        $scss->setVariables($settings['variables']);
        if ($settings['options']['sourceMap']) {
            $scss->setSourceMap(Compiler::SOURCE_MAP_INLINE);
            $scss->setSourceMapOptions([
                'sourceMapRootpath' => $settings['cache']['tempDirectoryRelativeToRoot'],
                'sourceMapBasepath' => '<PATH DOES NOT EXIST BUT SUPRESSES WARNINGS>'
            ]);
        }
        $css = $scss->compile('@import "' . $file . '"');

        // Correct relative urls
        $absoluteFilename = GeneralUtility::getFileAbsFileName($file);
        $relativePath = $settings['cache']['tempDirectoryRelativeToRoot'] . dirname(substr($absoluteFilename, strlen(PATH_site))) . '/';
        $search = '%url\s*\(\s*[\\\'"]?(?!(((?:https?:)?\/\/)|(?:data:?:)))([^\\\'")]+)[\\\'"]?\s*\)%';
        $replace = 'url("' . $relativePath . '$3")';
        $css = preg_replace($search, $replace, $css);

        return [
            'filename' => $file,
            'css' => $css,
            'cache' => [
                'version' => Version::VERSION,
                'date' => date('r'),
                'css' => $css,
                'etag' => md5($css),
                'files' => $scss->getParsedFiles(),
                'variables' => $settings['variables'],
                'sourceMap' => $settings['options']['sourceMap']
            ]
        ];
    }

    /**
     * @param string $cacheFile
     * @param string $cacheFileMeta
     * @param array $settings
     * @return bool
     */
    protected function needsCompile($cacheFile, $cacheFileMeta, $settings)
    {
        $filetime = filemtime($cacheFile);
        $metadata = unserialize(file_get_contents($cacheFileMeta));

        foreach ($metadata['files'] as $file => $cacheTime) {
            $currentTime = filemtime($file);
            if ($currentTime !== $cacheTime || $currentTime > $filetime) {
                return true;
            }
        }

        if ($settings['variables'] !== $metadata['variables']) {
            return true;
        }

        if ($settings['options']['sourceMap'] !== $metadata['sourceMap']) {
            return true;
        }

        return false;
    }

    /**
     * @param string $file
     * @param array $settings
     * @return bool
     */
    protected function isCached($file, $settings)
    {
        $cacheIdentifier = $this->getCacheIdentifier($file, $settings);
        $cacheFile = $this->getCacheFile($cacheIdentifier, $settings['cache']['tempDirectory']);
        $cacheFileMeta = $this->getCacheFileMeta($cacheFile);

        return file_exists($cacheFile) && file_exists($cacheFileMeta);
    }

    /**
     * @param string $cacheIdentifier
     * @param string $tempDirectory
     * @return string
     */
    protected function getCacheFile($cacheIdentifier, $tempDirectory)
    {
        return $tempDirectory . $cacheIdentifier . '.css';
    }

    /**
     * @param string $filename
     * @return string
     */
    protected function getCacheFileMeta($filename)
    {
        return $filename . '.meta';
    }

    /**
     * @param string $file
     * @param array $settings
     * @return string
     */
    protected function getCacheIdentifier($file, $settings)
    {
        $filehash = md5($file);
        $hash = hash('sha256', $filehash . serialize($settings));

        return basename($file, '.scss') . '-' . $hash;
    }
}
