<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * ExternalMediaUtility
 */
class ExternalMediaUtility
{

    /**
     * @var array Provider that can be handled, the provider is equal the hostname and needs a process function
     */
    protected $mediaProvider = [
        'youtube',
        'youtu',
        'vimeo'
    ];

    /**
     * Get the embed code for the given url if possible
     * and add a css class on the iframe
     *
     * @param string $url
     * @param string $class
     * @return string
     */
    public function getEmbedCode($url, $class)
    {
        // Prepare url
        $url = $this->setProtocolToHttps($url);
        // Get method
        $method = $this->getMethod($url);
        if ($method !== null) {
            $embedUrl = $this->{$method}($url);
            if ($embedUrl) {
                $content = '
                    <iframe class="' . $class . '" src="' . $embedUrl . '" frameborder="0" allowfullscreen></iframe>
                ';
                return $content;
            }
        }
        return null;
    }

    /**
     * Resolves if possible a method name to process the url
     *
     * @param string $url
     * @return string|null
     */
    protected function getMethod($url)
    {
        $urlInformation = @parse_url($url);
        $hostName = GeneralUtility::trimExplode('.', $urlInformation['host'], true);
        foreach ($this->mediaProvider as $provider) {
            $functionName = 'process' . ucfirst($provider);
            if (in_array($provider, $hostName) && is_callable([$this, $functionName])) {
                return $functionName;
            }
        }
        return null;
    }

    /**
     * Processes YouTube url
     *
     * @param string $url
     * @return string
     */
    protected function processYoutube($url)
    {
        $matches = [];
        $pattern = '%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=))([^"&?/ ]{11})(?:.+)?$%xs';
        if (preg_match($pattern, $url, $matches)) {
            $toEmbed = $matches[1];
            $patternForAdditionalParams = '%^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=))(?:[^"&?\/ ]{11})(.+)?(?:.+)?$%xs';
            if (preg_match($patternForAdditionalParams, $url, $matches)) {
                $toEmbed .= '?' . substr($matches[1], 1);
            }
            return 'https://www.youtube.com/embed/' . $toEmbed;
        }
        return null;
    }

    /**
     * Process YouTube short url
     *
     * @param string $url
     * @return string
     */
    protected function processYoutu($url)
    {
        return $this->processYoutube($url);
    }

    /**
     * Processes Vimeo url
     *
     * @param string $url
     * @return string
     */
    protected function processVimeo($url)
    {
        $matches = [];
        if (preg_match('/[\\/#](\\d+)$/', $url, $matches)) {
            return 'https://player.vimeo.com/video/' . $matches[1];
        }
        return null;
    }

    /**
     * Change every protocol to https and add it if missing
     *
     * @param  string $url URL
     * @return string
     */
    protected function setProtocolToHttps($url)
    {
        $processUrl = trim($url);
        if (substr($url, 0, 7) === 'http://') {
            $processUrl = substr($processUrl, 7);
        } elseif (substr($processUrl, 0, 8) === 'https://') {
            $processUrl = substr($processUrl, 8);
        } elseif (substr($processUrl, 0, 2) === '//') {
            $processUrl = substr($processUrl, 2);
        }
        return 'https://' . $processUrl;
    }
}
