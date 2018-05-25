<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Hooks\PageRenderer;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use BK2K\BootstrapPackage\Service\GoogleFontService;

/**
 * GoogleFontHook
 */
class GoogleFontHook
{
    /**
     * @var array
     */
    protected $includeMapping = [
        'includeCSSLibs' => 'cssLibs',
        'includeCSS' => 'cssFiles'
    ];

    /**
     * @var \BK2K\BootstrapPackage\Service\GoogleFontService
     */
    protected $googleFontService;

    /**
     * @param array $params
     * @param \TYPO3\CMS\Core\Page\PageRenderer $pagerenderer
     */
    public function execute(&$params, &$pagerenderer)
    {
        if (TYPO3_MODE !== 'FE') {
            return;
        }
        foreach (['cssLibs', 'cssFiles'] as $key) {
            $files = [];
            if (is_array($params[$key])) {
                foreach ($params[$key] as $file => $settings) {
                    $cachedFile = $this->getGoogleFontService()->getCachedFile($file);
                    if ($cachedFile !== false) {
                        $settings['file'] = $cachedFile;
                        $files[$cachedFile] = $settings;
                    } else {
                        $files[$file] = $settings;
                    }
                    $params[$key] = $files;
                }
            }
        }
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump([
            'cssLibs' => $params['cssLibs'],
            'cssFiles' => $params['cssFiles']
        ]);
    }

    /**
     * Get the google font service
     *
     * @return Dispatcher
     */
    protected function getGoogleFontService()
    {
        if (!isset($this->googleFontService)) {
            $this->googleFontService = GeneralUtility::makeInstance(GoogleFontService::class);
        }
        return $this->googleFontService;
    }

    /**
     * @return TemplateService
     */
    private function getTemplateService()
    {
        return $GLOBALS['TSFE']->tmpl;
    }
}
