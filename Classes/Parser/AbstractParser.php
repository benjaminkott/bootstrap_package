<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Parser;

use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * AbstractParser
 */
abstract class AbstractParser implements ParserInterface
{
    /**
     * @param string $extension
     * @return bool
     */
    public function supports($extension)
    {
        return false;
    }

    /**
     * @param string $file
     * @param array $settings
     * @return string
     */
    public function compile($file, $settings)
    {
        return $file;
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
     * @param string $cacheFile
     * @param string $cacheFileMeta
     * @param array $settings
     * @return bool
     */
    protected function needsCompile($cacheFile, $cacheFileMeta, $settings)
    {
        $needCompilation = false;
        $fileModificationTime = filemtime($cacheFile);
        $metadata = unserialize(file_get_contents($cacheFileMeta), ['allowed_classes' => false]);

        foreach ($metadata['files'] as $file => $cacheTime) {
            $currentTime = filemtime($file);
            if ($currentTime !== $cacheTime || $currentTime > $fileModificationTime) {
                $needCompilation = true;
                break;
            }
        }

        if (!$needCompilation && $settings['variables'] !== $metadata['variables']) {
            $needCompilation = true;
        }

        if (!$needCompilation && $settings['options']['sourceMap'] !== $metadata['sourceMap']) {
            $needCompilation = true;
        }

        return $needCompilation;
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
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        return basename($file, '.' . $extension) . '-' . $hash;
    }

    /**
     * @return string
     */
    protected function getPathSite()
    {
        if (class_exists('TYPO3\CMS\Core\Core\Environment', false)) {
            return Environment::getPublicPath() . '/';
        } else {
            return PATH_site;
        }
    }

    /**
     * Clear all page caches
     * @throws \TYPO3\CMS\Core\Cache\Exception\NoSuchCacheGroupException
     */
    protected function clearPageCaches()
    {
        GeneralUtility::makeInstance(CacheManager::class)->flushCachesInGroup('pages');
    }
}
