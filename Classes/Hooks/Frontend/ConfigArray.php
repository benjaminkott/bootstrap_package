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
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * ConfigArray
 */
class ConfigArray
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
    public function postProc(&$params, &$tsfe)
    {
        $language = GeneralUtility::_GP('L');
        $languageUid = (MathUtility::canBeInterpretedAsInteger($language)) ? (int)$language : 0;

        $languageRec = $this->getLanguageData($languageUid);

        $htmlTagParams = '';
        if (!empty($languageRec['hreflang'])) {
            $htmlTagParams .= 'lang="' . $languageRec['hreflang'] . '" ';
        }
        if (!empty($languageRec['direction'])) {
            $htmlTagParams .= 'dir="' . $languageRec['direction'] . '" ';
        }
        $htmlTagParams .= 'class="no-js"';

        echo '<pre>';
        var_dump($params);

        $params['config']['sys_language_uid'] = $languageUid;
        $params['config']['language'] = $languageRec['language'];
        $params['config']['locale_all'] = $languageRec['locale'];
        $params['config']['htmlTag_setParams'] = $htmlTagParams;

        echo '<br>';
        var_dump($params);
        echo '</pre>';
    }
}
