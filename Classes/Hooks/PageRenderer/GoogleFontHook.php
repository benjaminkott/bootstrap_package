<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Hooks\PageRenderer;

use BK2K\BootstrapPackage\Service\GoogleFontService;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Http\ApplicationType;
use TYPO3\CMS\Core\TypoScript\TemplateService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
    public function execute(&$params, &$pagerenderer): void
    {
        if (!($GLOBALS['TYPO3_REQUEST'] ?? null) instanceof ServerRequestInterface ||
            !ApplicationType::fromRequest($GLOBALS['TYPO3_REQUEST'])->isFrontend() ||
            (!is_array($params['cssFiles']) && !is_array($params['cssLibs']))
        ) {
            return;
        }

        foreach ($this->includeMapping as $include => $section) {
            if (is_array($params[$section])) {
                $files = [];
                foreach ($params[$section] as $file => $settings) {
                    $cachedFile = $this->getGoogleFontService()->getCachedFile($file);
                    if ($cachedFile !== null) {
                        $this->adjustTypoScriptCssConfiguration($include, $file, $cachedFile);
                        $settings['file'] = $cachedFile;
                        $files[$cachedFile] = $settings;
                    } else {
                        $files[$file] = $settings;
                    }
                    $params[$section] = $files;
                }
            }
        }
    }

    /**
     * @param string $include
     * @param string $file
     * @param string $cachedFile
     */
    protected function adjustTypoScriptCssConfiguration($include, $file, $cachedFile): void
    {
        $includeFilesConfiguration = $this->getTemplateService()->setup['page.'][$include . '.'];
        if (is_array($includeFilesConfiguration) && count($includeFilesConfiguration) > 0) {
            foreach ($includeFilesConfiguration as $includeKey => $includeFilename) {
                if (substr($includeKey, -1) === '.') {
                    continue;
                }
                if ($file === $includeFilename) {
                    $this->getTemplateService()->setup['page.'][$include . '.'][$includeKey] = $cachedFile;
                    break;
                }
            }
        }
    }

    /**
     * Get the google font service
     *
     * @return GoogleFontService
     */
    protected function getGoogleFontService(): GoogleFontService
    {
        if ($this->googleFontService === null) {
            $this->googleFontService = GeneralUtility::makeInstance(GoogleFontService::class);
        }
        return $this->googleFontService;
    }

    /**
     * @return TemplateService
     */
    private function getTemplateService(): TemplateService
    {
        $frontendController = $GLOBALS['TYPO3_REQUEST']->getAttribute('frontend.controller', $GLOBALS['TSFE']);
        return $frontendController->tmpl;
    }
}
