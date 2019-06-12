<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * GoogleFontService
 */
class GoogleFontService
{
    /**
     * @var string
     */
    protected $tempDirectory = 'typo3temp/assets/bootstrappackage/fonts';

    /**
     * @var string
     */
    protected $googleFontApiUrl = 'fonts.googleapis.com/css';

    /**
     * @param string $file
     * @return bool|string
     * @throws \Exception
     */
    public function getCachedFile($file)
    {
        if (!$this->supports($file)) {
            return false;
        }
        if ($this->isCached($file)) {
            return $this->getCssFileCacheName($file);
        }
        return $this->cacheFile($file) ? $this->getCssFileCacheName($file) : false;
    }

    /**
     * @param string $file
     * @return bool
     */
    protected function cacheFile($file)
    {
        $content = GeneralUtility::getUrl(
            $file,
            0,
            ['User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36 Edge/17.17134']
        );

        if (!$content) {
            return false;
        }

        // Ensure cache directory exists
        GeneralUtility::mkdir_deep($this->tempDirectory . '/' . $this->getCacheIdentifier($file));

        // Find and Download font files
        $pattern = '%url\((.*?)\)%';
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);
        $fontFiles = [];
        foreach ($matches as $match) {
            $fontFiles[$match[1]] = $match[1];
        }
        foreach ($fontFiles as $fontFile) {
            $localFontFile = $this->getCacheDirectory($file) . '/' . basename($fontFile);
            $fontFileContent = GeneralUtility::getUrl($fontFile);
            file_put_contents($localFontFile, $fontFileContent);
            GeneralUtility::fixPermissions($localFontFile);
            $content = str_replace($fontFile, basename($fontFile), $content);
        }

        // Save CSS File
        $cacheFile = $this->getCacheDirectory($file) . '/' . 'webfont.css';
        file_put_contents(GeneralUtility::getFileAbsFileName($cacheFile), $content);
        GeneralUtility::fixPermissions($cacheFile);

        return true;
    }

    /**
     * @param string $file
     * @return bool
     */
    protected function supports($file)
    {
        return strpos($file, $this->googleFontApiUrl) ? true : false;
    }

    /**
     * @param string $file
     * @return bool
     */
    protected function isCached($file)
    {
        $cacheFile = $this->getCssFileCacheName($file);
        $absoluteFile = GeneralUtility::getFileAbsFileName($cacheFile);

        if (!file_exists($absoluteFile)) {
            return false;
        }

        // Discard cache after 24 hours
        if ((time() - filemtime($absoluteFile)) > 86400) {
            GeneralUtility::rmdir($this->getCacheDirectory($file));
            return false;
        }

        return true;
    }

    /**
     * @param string $file
     * @return string
     */
    protected function getCssFileCacheName($file)
    {
        return $this->getCacheDirectory($file) . '/' . 'webfont.css';
    }

    /**
     * @param string $file
     * @return string
     */
    protected function getCacheDirectory($file)
    {
        return $this->tempDirectory . '/' . $this->getCacheIdentifier($file);
    }

    /**
     * @param string $file
     * @return string
     */
    protected function getCacheIdentifier($file)
    {
        return hash('sha256', $file);
    }
}
