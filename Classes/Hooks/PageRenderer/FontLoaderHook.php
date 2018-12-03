<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Hooks\PageRenderer;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\TypoScript\TemplateService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

/**
 * FontLoaderHook
 */
class FontLoaderHook
{
    /**
     * @var array
     */
    protected $includeMapping = [
        'includeCSSLibs' => 'cssLibs',
        'includeCSS' => 'cssFiles'
    ];

    /**
     * @param array $params
     * @param PageRenderer $pagerenderer
     */
    public function execute(&$params, &$pagerenderer)
    {
        if (TYPO3_MODE !== 'FE' ||
            (!is_array($params['cssFiles']) && !is_array($params['cssLibs']))
        ) {
            return;
        }

        $webFonts = [];
        foreach ($this->includeMapping as $include => $section) {
            $webFonts = array_merge($webFonts, $this->collectWebFonts($include, $section));
        }

        $urls = [];
        $families = [];
        if (count($webFonts) > 0) {
            foreach ($webFonts as $font) {
                if (isset($params[$font['section']][$font['filename']])) {
                    unset($params[$font['section']][$font['filename']]);
                    $urls = array_merge($urls, [$font['url']]);
                    $families = array_merge($families, $font['families']);
                }
            }
        }

        $config = [];
        if (count($urls) > 0 || count($families) > 0) {
            $config['custom']['urls'] = $urls;
            $config['custom']['families'] = $families;
            $config['timeout'] = 1000;
            $params['headerData'][] = '<style>' . $this->generateCss() . '</style>';
            $params['headerData'][] = '<script>' . $this->generateJavaScript($config) . '</script>';
        }
    }

    /**
     * @param $include
     * @param $section
     * @return array
     */
    private function collectWebFonts($include, $section)
    {
        $webFonts = [];
        $cssIncludes = $this->getPageCssConfiguration($include);
        foreach ($cssIncludes as $key => $filename) {
            if (substr($key, -1) === '.') {
                continue;
            }
            if ($cssIncludes[$key . '.']['fontLoader.']['enabled']) {
                $filename = $this->getTemplateService()->getFileName($filename);
                $url = str_replace(' ', '+', $filename);
                $url = $this->getUriForFileName($url);
                $webFonts[$section . '_' . $key] = [
                    'include' => $include,
                    'section' => $section,
                    'filename' => $filename,
                    'url' => $url,
                    'families' => $cssIncludes[$key . '.']['fontLoader.']['families.'] ?: []
                ];
            }
        }
        return $webFonts;
    }

    /**
     * @param array $config
     * @return string
     */
    private function generateJavaScript($config)
    {
        $inlineJavaScript = [];
        $inlineJavaScript[] = 'WebFontConfig=' . json_encode($config) . ';';
        $inlineJavaScript[] = '(function(d){var wf=d.createElement(\'script\'),s=d.scripts[0];';
        $inlineJavaScript[] = 'wf.src=\'' . $this->getUriForFileName('EXT:bootstrap_package/Resources/Public/Contrib/webfontloader/webfontloader.js') . '\';';
        $inlineJavaScript[] = 'wf.async=false;';
        $inlineJavaScript[] = 's.parentNode.insertBefore(wf,s);';
        $inlineJavaScript[] = '})(document);';
        return implode('', $inlineJavaScript);
    }

    /**
     * @return string
     */
    private function generateCss()
    {
        $inlineStyle = [];

        if ($this->getTypoScriptConstant('page.preloader.enable')) {
            $bodyStyles = [];
            $bodyStyles[] = 'user-select:none;';
            $bodyStyles[] = 'pointer-events:none;';
            $bodyStyles[] = 'background-position:center center;';
            $bodyStyles[] = 'background-repeat:no-repeat;';
            $bodyStyles[] = 'content:\'\';';
            $bodyStyles[] = 'position:fixed;';
            $bodyStyles[] = 'top:-100%;';
            $bodyStyles[] = 'left:0;';
            $bodyStyles[] = 'z-index:10000;';
            $bodyStyles[] = 'opacity:0;';
            $bodyStyles[] = 'height:100%;';
            $bodyStyles[] = 'width:100%;';

            $backgroundColor = $this->getTypoScriptConstant('page.preloader.backgroundColor');
            if (!empty($backgroundColor)) {
                $bodyStyles[] = 'background-color:' . $backgroundColor . ';';
            } else {
                $bodyStyles[] = 'background-color:#ffffff;';
            }

            $logo = $this->getTypoScriptConstant('page.preloader.logo.file');
            if (!empty($logo)) {
                $logoFile = $this->getUriForFileName($logo);
                $logoHeight = (int) $this->getTypoScriptConstant('page.preloader.logo.height');
                $logoWidth = (int) $this->getTypoScriptConstant('page.preloader.logo.width');
                $bodyStyles[] = 'background-image: url(\'' . $logoFile . '\');';
                $bodyStyles[] = 'background-size:' . $logoWidth . 'px ' . $logoHeight . 'px;';
            }

            $loadingStyles = [];
            $bodyStyles[] = 'user-select:initial;';
            $bodyStyles[] = 'pointer-events:initial;';
            $loadingStyles[] = 'top:0;';
            $loadingStyles[] = 'opacity:1!important;';

            $duration = (float) $this->getTypoScriptConstant('page.preloader.fadeDuration');
            $transition = 'opacity ' . $duration . 's ease-out';
            $activeStyles = [];
            $activeStyles[] = 'top: 0;';
            $activeStyles[] = 'opacity:0!important;';
            $activeStyles[] = 'user-select:none;';
            $activeStyles[] = 'pointer-events:none;';
            $activeStyles[] = '-webkit-transition:' . $transition . ';';
            $activeStyles[] = '-moz-transition:' . $transition . ';';
            $activeStyles[] = '-o-transition:' . $transition . ';';
            $activeStyles[] = 'transition:' . $transition . ';';

            $inlineStyle[] = 'body:before{' . implode('', $bodyStyles) . '}';
            $inlineStyle[] = '.js body:before,.wf-loading body:before{' . implode('', $loadingStyles) . '}';
            $inlineStyle[] = '.wf-active body:before,.wf-inactive body:before{' . implode('', $activeStyles) . '}';
        }

        return implode('', $inlineStyle);
    }

    /**
     * @param string $section
     * @return array
     */
    private function getPageCssConfiguration($section)
    {
        if (isset($this->getTemplateService()->setup['page.'][$section . '.'])) {
            return $this->getTemplateService()->setup['page.'][$section . '.'];
        }
        return [];
    }

    /**
     * @param string $typoscriptConstant
     * @return string
     */
    private function getTypoScriptConstant($typoscriptConstant)
    {
        if (!isset($this->getTemplateService()->flatSetup)
            || !is_array($this->getTemplateService()->flatSetup)
            || count($this->getTemplateService()->flatSetup) === 0) {
            $this->getTemplateService()->generateConfig();
        }
        if (isset($this->getTemplateService()->flatSetup[$typoscriptConstant])) {
            return $this->getTemplateService()->flatSetup[$typoscriptConstant];
        }
        return '';
    }

    /**
     * @return TemplateService
     */
    private function getTemplateService()
    {
        return $GLOBALS['TSFE']->tmpl;
    }

    /**
     * @param string $filename
     * @return string
     */
    private function getUriForFileName($filename)
    {
        if (strpos($filename, '://')) {
            return $filename;
        }
        $urlPrefix = '';
        if (strpos($filename, 'EXT:') === 0) {
            $absoluteFilename = GeneralUtility::getFileAbsFileName($filename);
            $filename = '';
            if ($absoluteFilename !== '') {
                $filename = PathUtility::getAbsoluteWebPath($absoluteFilename);
            }
        } elseif (strpos($filename, '/') !== 0) {
            $urlPrefix = GeneralUtility::getIndpEnv('TYPO3_SITE_PATH');
        }
        return $urlPrefix . $filename;
    }
}
