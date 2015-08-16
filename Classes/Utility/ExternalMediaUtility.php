<?php
namespace BK2K\BootstrapPackage\Utility;

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
class ExternalMediaUtility
{

    /**
     * @var array Provider that can be handled, the provider is equal the hostname and needs a process function
     */
    protected $mediaProvider = array(
        'youtube',
        'youtu',
        'vimeo'
    );

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
        if ($method) {
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
     * @return string
     */
    protected function getMethod($url)
    {
        $urlInformation = @parse_url($url);
        $hostName = GeneralUtility::trimExplode('.', $urlInformation['host'], true);
        foreach ($this->mediaProvider as $provider) {
            $functionName = 'process' . ucfirst($provider);
            if (in_array($provider, $hostName) && is_callable(array($this, $functionName))) {
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
        $matches = array();
        $pattern = '%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=))([^"&?/ ]{11})(?:.+)?$%xs';
        if (preg_match($pattern, $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
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
        $matches = array();
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
        if (substr($url, 0, 7) === "http://") {
            $processUrl = substr($processUrl, 7);
        } elseif (substr($processUrl, 0, 8) === "https://") {
            $processUrl = substr($processUrl, 8);
        } elseif (substr($processUrl, 0, 2) === "//") {
            $processUrl = substr($processUrl, 2);
        }
        return 'https://' . $processUrl;
    }
}
