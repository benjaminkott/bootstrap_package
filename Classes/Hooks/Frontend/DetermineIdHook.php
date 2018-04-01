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
 * DetermineIdHook
 */
class DetermineIdHook
{
    const SYS_LANGUAGE_UID_PLACEHOLDER = '###SYSLANGUAGEUIDPLACEHOLDER###';
    const LANGUAGE_PLACEHOLDER = '###LANGUAGEPLACEHOLDER###';
    const LOCALE_PLACEHOLDER = '###LOCALEPLACEHOLDER###';
    const HREF_LANG_PLACEHOLDER = '###HREFLANGPLACEHOLDER###';
    const DIRECTION_PLACEHOLDER = '###DIRECTIONPLACEHOLDER###';

    /**
     * @var string
     */
    protected $tempDirectory = 'typo3temp/assets/bootstrappackage/';

    /**
     * @var array
     */
    protected $includeHeader = [];

    /**
     * @var array
     */
    protected $includeContent = [
        '[globalVar = GP:L = ###SYSLANGUAGEUIDPLACEHOLDER###]',
        'config {',
        '    sys_language_uid = ###SYSLANGUAGEUIDPLACEHOLDER###',
        '    language = ###LANGUAGEPLACEHOLDER###',
        '    locale_all = ###LOCALEPLACEHOLDER###',
        '    htmlTag_setParams = lang="###HREFLANGPLACEHOLDER###" dir="###DIRECTIONPLACEHOLDER###" class="no-js"',
        '}',
        '[global]'
    ];

    /**
     * @var array
     */
    protected $includeFooter = [];

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
    protected function updateConfig(&$params, &$tsfe)
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

        /*
        echo '<pre>';
        var_dump($params);
        */

        $params['config']['sys_language_uid'] = $languageUid;
        $params['config']['language'] = $languageRec['language'];
        $params['config']['locale_all'] = $languageRec['locale'];
        $params['config']['htmlTag_setParams'] = $htmlTagParams;

        /*
        echo '<br>';
        var_dump($params);
        echo '</pre>';
        */
    }

    /**
     * Overrides various config settings
     *
     * @param array $params
     * @param TypoScriptFrontendController $tsfe
     */
    public function manipulateCacheConfig(&$params, &$tsfe)
    {
        $_params = &$params['cache_pages_row']['cache_data'];

        echo '<pre>';
        echo 'manipulateCacheConfig<br>';
        var_dump($_params);

        $this->updateConfig($_params, $tsfe);

        echo '<hr>';
        var_dump($_params);
        echo '</pre>';
    }

    /**
     * Overrides various config settings
     *
     * @param array $params
     * @param TypoScriptFrontendController $tsfe
     */
    public function manipulateConfig(&$params, &$tsfe)
    {
        $_params = &$params;

        echo '<pre>';
        echo 'manipulateConfig<br>';
        var_dump($_params);

        $this->updateConfig($_params, $tsfe);

        echo '<hr>';
        var_dump($_params);
        echo '</pre>';
    }

    /**
     * Overrides various config settings
     *
     * @param array $params
     * @param TypoScriptFrontendController $tsfe
     */
    public function createTSSetupInclude(&$params, &$tsfe)
    {
        /* $_params = ['pObj' => &$this]; */
        $filepath = PATH_site . $this->tempDirectory . 'tssetup_language_conditions.typoscript';

        if (!@is_file($filepath)) {
            $language = GeneralUtility::_GP('L');
            $languageUid = (MathUtility::canBeInterpretedAsInteger($language)) ? (int)$language : 0;

            $languageRec = $this->getLanguageData($languageUid);

            $includeFile = implode(LF, $includeHeader + $includeContentHeader + $includeFooterHeader);

            $includeFile = str_replace(self::SYS_LANGUAGE_UID_PLACEHOLDER, $link, $languageUid);
            $includeFile = str_replace(self::LANGUAGE_PLACEHOLDER, $link, $languageRec['language']);
            $includeFile = str_replace(self::LOCALE_PLACEHOLDER, $link, $languageRec['locale']);
            $includeFile = str_replace(self::HREF_LANG_PLACEHOLDER, $link, $languageRec['hreflang']);
            $includeFile = str_replace(self::DIRECTION_PLACEHOLDER, $link, $languageRec['direction']);

            GeneralUtility::writeFileToTypo3tempDir(
                $filepath,
                $includeFile . LF
            );
        }
    }
}
