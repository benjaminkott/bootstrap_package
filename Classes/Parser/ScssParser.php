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
use TYPO3\CMS\Core\Utility\PathUtility;

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
            require_once ExtensionManagementUtility::extPath('bootstrap_package') . '/Contrib/scssphp/scss.inc.php';
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

        $css = $scss->compile($this->resolveCode($file));

        $absoluteFilename = GeneralUtility::getFileAbsFileName($file);
        $relativePath = $settings['cache']['tempDirectoryRelativeToRoot'] . dirname(substr($absoluteFilename, strlen($this->getPathSite()))) . '/';
        $search = '%url\s*\(\s*[\\\'"]?(?!(((?:https?:)?\/\/)|(?:data:?:)))([^\\\'")]+)[\\\'"]?\s*\)%';
        $replace = 'url("' . $relativePath . '$3")';
        $css = preg_replace($search, $replace, $css);

        $parsedFiles = $scss->getParsedFiles();
        if (!isset($parsedFiles[$absoluteFilename])) {
            $parsedFiles[$absoluteFilename] = filemtime($absoluteFilename);
        }

        return [
            'css' => $css,
            'cache' => [
                'version' => Version::VERSION,
                'date' => date('r'),
                'css' => $css,
                'etag' => md5($css),
                'files' => $parsedFiles,
                'variables' => $settings['variables'],
                'sourceMap' => $settings['options']['sourceMap']
            ]
        ];
    }

    /**
     * Substitutes relative @import paths with according matching visual paths.
     * This scenarios happens, when e.g. developing packages using the `path`
     * repository feature of Composer - having one package in `public/typo3conf/ext/`
     * and the other one symlinked in e.g. `packages/`.
     *
     * Since the SCSS parser works on resolved real paths, the symlinked context
     * is lost. This method tries to keep the meaning for resolving absolute
     * references to their matching directories.
     *
     * @param string $file
     * @return string
     */
    protected function resolveCode($file)
    {
        $visualFilePath = GeneralUtility::getFileAbsFileName($file);
        $realFilePath = realpath($visualFilePath);
        if ($visualFilePath === $realFilePath) {
            return '@import "' . $file . '"';
        }

        $visualDirectory = dirname($visualFilePath);
        $realDirectory = dirname($realFilePath);
        $code = file_get_contents($visualFilePath);
        if (preg_match_all('#@import\s+"([^"]+)"#', $code, $matches)) {
            $substitutes = [];
            foreach ($matches[1] as $index => $import) {
                if (strpos($import, '/') === 0) {
                    continue;
                }
                $realCandidate = PathUtility::getCanonicalPath(
                    $realDirectory . '/' . $import
                );
                $visualCandidate = PathUtility::getCanonicalPath(
                    $visualDirectory . '/' . $import
                );
                if (!file_exists(dirname($realCandidate))
                    && file_exists(dirname($visualCandidate))) {
                    $importLine = $matches[0][$index];
                    $substitutes[$importLine] = str_replace(
                        $import,
                        $visualCandidate,
                        $importLine
                    );
                }
            }
            if (!empty($substitutes)) {
                $code = str_replace(
                    array_keys($substitutes),
                    array_values($substitutes),
                    $code
                );
            }
        }
        return $code;
    }
}
