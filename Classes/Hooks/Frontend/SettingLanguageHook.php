<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Hooks\Frontend;

use BK2K\BootstrapPackage\Utility\LanguageUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

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
        $language = $this->getLanguageData($languageUid);

        $htmlTagParams = '';
        if (!empty($language['hreflang'])) {
            $htmlTagParams .= 'lang="' . $language['hreflang'] . '" ';
        }
        if (!empty($language['direction'])) {
            $htmlTagParams .= 'dir="' . $language['direction'] . '" ';
        }
        $htmlTagParams .= 'class="no-js"';

        $tsfe->config['config']['sys_language_uid'] = $languageUid;
        $tsfe->config['config']['language'] = $language['language'];
        $tsfe->config['config']['locale_all'] = $language['locale'];
        $tsfe->config['config']['htmlTag_setParams'] = $htmlTagParams;
    }

    /**
     * Overrides various config settings
     *
     * @param array $params
     * @param TypoScriptFrontendController $tsfe
     */
    public function preProcess2(&$params, &$tsfe)
    {
        $languageUid = GeneralUtility::_GPmerged('L');
        $language = $this->getLanguageData($languageUid);

        echo '<pre>';
        echo 'L:'.$languageUid;
        var_dump($language);
        var_dump($tsfe->config['config']);
        echo '</pre>';
    }
}
