<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Hooks\FrontEnd;

use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
use TYPO3\CMS\Core\TypoScript\TemplateService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use BK2K\BootstrapPackage\Utility\LanguageUtility;

/**
 * SettingLanguageHook
 */
class SettingLanguageHook
{
    /**
     * Gets the language data for the languageUid
     *
     * @param int $languageUid
     * @return string JSON encoded data
     */
    protected function getLanguageData($languageUid)
    {
        return LanguageUtility::getLanguageData($languageUid);
    }

    /**
     * Overrides various config settings
     * 
     * @param array $params
     * @param TypoScriptFrontendController $tsfe
     */
    public function preProcess(&$params, &$tsfe)
    {
        $languageUid = GeneralUtility::_GPmerged('L');
        $language = getLanguageData($languageUid);

        $htmlTagParams = '';
        if (!empty($language[$languageUid]['hreflang'])) {
            $htmlTagParams .= 'lang="' . $language[$languageUid]['hreflang'] . '" ';
        }
        if (!empty($language[$languageUid]['direction'])) {
            $htmlTagParams .= 'dir="' . $language[$languageUid]['direction'] . '" ';
        }
        $htmlTagParams .= 'class="no-js"';

        $tsfe->config['config']['sys_language_uid'] = $languageUid;        
        $tsfe->config['config']['language'] = $language[$languageUid]['language'];
        $tsfe->config['config']['locale_all'] = $language[$languageUid]['locale'];
        $tsfe->config['config']['htmlTag_setParams'] = $htmlTagParams;
    }
}
