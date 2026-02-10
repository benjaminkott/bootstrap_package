<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Service;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Crypto\HashService;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * GoogleFontService
 */
class GoogleFontService
{
    /**
     * Relative path from public directory for cached font files (must be web-accessible)
     */
    protected const CACHE_DIRECTORY = 'typo3temp/assets/bootstrappackage/fonts';

    protected const GOOGLE_FONTS_HOST = 'fonts.googleapis.com';

    /**
     * Allowed MIME types for font files
     * @var list<string>
     */
    protected array $allowedFontMimeTypes = [
        'font/woff',
        'font/woff2',
        'font/ttf',
        'font/otf',
        'application/font-woff',
        'application/font-woff2',
        'application/x-font-woff',
        'application/x-font-ttf',
        'application/x-font-otf',
        'application/vnd.ms-fontobject',
        'font/sfnt',
    ];

    public function getCachedFile(string $url): ?string
    {
        if (!$this->supports($url)) {
            return null;
        }
        if ($this->isCached($url)) {
            return $this->getCssFileCacheName($url);
        }
        return $this->cacheUrl($url) ? $this->getCssFileCacheName($url) : null;
    }

    protected function cacheUrl(string $url): bool
    {
        /** @var RequestFactory */
        $requestFactory = GeneralUtility::makeInstance(RequestFactory::class);

        /** @var ResponseInterface */
        $response = $requestFactory->request($url, 'GET', [
            'headers' => ['User-Agent' => 'Mozilla/5.0 Gecko/20100101 Firefox/94.0 AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36 Edg/97.0.1072.55'],
        ]);

        if ($response->getStatusCode() >= 300) {
            return false;
        }
        $content = $response->getBody()->getContents();

        // Ensure cache directory exists
        GeneralUtility::mkdir_deep($this->getAbsoluteCacheDirectory($url));

        // Find and download font files
        $pattern = '%url\((.*?)\)%';
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);
        $fontUrls = [];
        foreach ($matches as $match) {
            $fontUrls[$match[1]] = $match[1];
        }
        foreach ($fontUrls as $fontUrl) {
            if (!$this->isValidHttpsUrl($fontUrl)) {
                continue;
            }

            /** @var ResponseInterface */
            $response = $requestFactory->request($fontUrl);
            if ($response->getStatusCode() >= 300) {
                continue;
            }

            // Validate MIME type of the response
            if (!$this->isAllowedFontMimeType($response)) {
                continue;
            }

            $fontFileContent = $response->getBody()->getContents();
            $localFontFile = $this->getAbsoluteCacheDirectory($url) . '/' . basename($fontUrl);
            file_put_contents($localFontFile, $fontFileContent);
            GeneralUtility::fixPermissions($localFontFile);
            $content = str_replace($fontUrl, basename($fontUrl), $content);
        }

        // Save CSS file
        $cacheFile = $this->getAbsoluteCacheDirectory($url) . '/webfont.css';
        file_put_contents($cacheFile, $content);
        GeneralUtility::fixPermissions($cacheFile);

        return true;
    }

    protected function isValidHttpsUrl(string $url): bool
    {
        // as prior to TYPO3 v14 arguments were not encoded, and it's common to use whitespaces in Google font URLs,
        // we'll replace them for now
        return filter_var(str_replace(' ', '+', $url), FILTER_VALIDATE_URL) !== false
            && str_starts_with($url, 'https://');
    }

    /**
     * Check if the response has an allowed font MIME type
     */
    protected function isAllowedFontMimeType(ResponseInterface $response): bool
    {
        $contentType = $response->getHeaderLine('Content-Type');
        if ($contentType === '') {
            return false;
        }

        // Extract MIME type without charset or other parameters
        $mimeType = strtolower(trim(explode(';', $contentType)[0]));

        return in_array($mimeType, $this->allowedFontMimeTypes, true);
    }

    /**
     * Check if the URL is a valid Google Fonts CSS API URL
     */
    protected function supports(string $url): bool
    {
        if (!$this->isValidHttpsUrl($url)) {
            return false;
        }

        return parse_url($url, PHP_URL_HOST) === self::GOOGLE_FONTS_HOST;
    }

    protected function isCached(string $url): bool
    {
        $absoluteFile = $this->getAbsoluteCacheDirectory($url) . '/webfont.css';

        if (!file_exists($absoluteFile)) {
            return false;
        }

        // Discard cache after 24 hours
        if ((time() - (int) filemtime($absoluteFile)) > 86400) {
            GeneralUtility::rmdir($this->getAbsoluteCacheDirectory($url));
            return false;
        }

        return true;
    }

    /**
     * Returns the relative path to the cached CSS file (for use in frontend)
     */
    protected function getCssFileCacheName(string $url): string
    {
        return $this->getCacheDirectory($url) . '/webfont.css';
    }

    /**
     * Returns the relative cache directory path (for use in frontend URLs)
     */
    protected function getCacheDirectory(string $url): string
    {
        return self::CACHE_DIRECTORY . '/' . $this->getCacheIdentifier($url);
    }

    /**
     * Returns the absolute cache directory path (for file system operations)
     */
    protected function getAbsoluteCacheDirectory(string $url): string
    {
        return Environment::getPublicPath() . '/' . $this->getCacheDirectory($url);
    }

    protected function getCacheIdentifier(string $url): string
    {
        return GeneralUtility::makeInstance(HashService::class)->hmac($url, 'GoogleFontService');
    }
}
