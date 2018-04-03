<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Hooks\Frontend;

use BK2K\BootstrapPackage\Utility\LanguageUtility;
use TYPO3\CMS\Core\TypoScript\TemplateService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * TSGenerator
 */
class TSGenerator
{
    const SYS_LANGUAGE_UID_PLACEHOLDER = '###SYSLANGUAGEUIDPLACEHOLDER###';
    const LANGUAGE_PLACEHOLDER = '###LANGUAGEPLACEHOLDER###';
    const LOCALE_PLACEHOLDER = '###LOCALEPLACEHOLDER###';
    const HREF_LANG_PLACEHOLDER = '###HREFLANGPLACEHOLDER###';
    const DIRECTION_PLACEHOLDER = '###DIRECTIONPLACEHOLDER###';

    /**
     * @var string
     */
    protected $tempDirectory = 'typo3temp/var/Cache/Code/bootstrappackage/';

    /**
     * @var array
     */
    protected $includeHeader = [];

    /**
     * @var array
     */
    protected $includeContent = [
        '[globalVar = GP:L = ' . self::SYS_LANGUAGE_UID_PLACEHOLDER . ']',
        'config {',
        '    sys_language_uid = ' . self::SYS_LANGUAGE_UID_PLACEHOLDER,
        '    language = ' . self::LANGUAGE_PLACEHOLDER,
        '    locale_all = ' . self::LOCALE_PLACEHOLDER,
        '    htmlTag_setParams = lang="' . self::HREF_LANG_PLACEHOLDER . '" dir="' . self::DIRECTION_PLACEHOLDER . '" class="no-js"',
        '}',
        '[global]'
    ];

    /**
     * @var array
     */
    protected $includeFooter = [];

    /**
     * Returns the TypoScript Setup language conditions
     *
     * @return string
     */
    protected function createLanguageConditions()
    {
        $content = implode(LF, $this->includeHeader);
        $languages = LanguageUtility::getLanguageRows();

        foreach ($languages as $languageUid => $languageRec) {
            $content .= implode(LF, $this->includeContent) . LF;

            $content = str_replace(self::SYS_LANGUAGE_UID_PLACEHOLDER, $languageUid, $content);
            $content = str_replace(self::LANGUAGE_PLACEHOLDER, $languageRec['language'], $content);
            $content = str_replace(self::LOCALE_PLACEHOLDER, $languageRec['locale'], $content);
            $content = str_replace(self::HREF_LANG_PLACEHOLDER, $languageRec['hreflang'], $content);
            $content = str_replace(self::DIRECTION_PLACEHOLDER, $languageRec['direction'], $content);
        }

        $content .= implode(LF, $this->includeFooter) . LF;

        return $content;
    }

    /**
     * Create TS language conditions include file if not exists
     *
     * @param array $params
     * @param TypoScriptFrontendController $tsfe
     */
    public function createTSSetupInclude(&$params, &$tsfe)
    {
        // todo: hook to delete file on language changes (sys_language and sys_site_language)
        $filepath = PATH_site . $this->tempDirectory . 'setup_language_conditions.typoscript';

        if (!@is_file($filepath)) {
            GeneralUtility::writeFileToTypo3tempDir(
                $filepath,
                $this->createLanguageConditions()
            );
        }
    }

    /**
     * Add TS language conditions to setup
     *
     * @param array $params
     * @param TemplateService $tmpl
     */
    public function addLanguageConditions(&$params, &$tmpl)
    {
        //$tmpl->constants[] = $row['constants'];
        $tmpl->config[] = $this->createLanguageConditions();
    }
}
