<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Hooks\Frontend;

use BK2K\BootstrapPackage\Utility\LanguageUtility;
use TYPO3\CMS\Core\TypoScript\TemplateService;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * Dynamically creates language config for TS Setup
 */
class TypoScriptLanguageHook
{
    const SYS_LANGUAGE_UID_PLACEHOLDER = '###SYSLANGUAGEUIDPLACEHOLDER###';
    const LANGUAGE_PLACEHOLDER = '###LANGUAGEPLACEHOLDER###';
    const LOCALE_PLACEHOLDER = '###LOCALEPLACEHOLDER###';
    const HREF_LANG_PLACEHOLDER = '###HREFLANGPLACEHOLDER###';
    const DIRECTION_PLACEHOLDER = '###DIRECTIONPLACEHOLDER###';

    /**
     * @var array
     */
    protected $constants = [
        '# customsubcategory=99=Language',
        'config.language.default {',
        '    # cat=bootstrap package: language/99/10; type=boolean; label=Enable Default Language: If not checked the default language will not be rendered',
        '    enable = 1',
        '    # cat=bootstrap package: language/99/20; type=string; label=Default Title: Title of the default language',
        '    title = English',
        '    # cat=bootstrap package: language/99/30; type=string; label=Default Navigation Title: Navigation title (e.g. "English", "Deutsch", "Français")',
        '    nav_title = English',
        '    # cat=bootstrap package: language/99/40; type=string; label=Default Locale: Language locale should be something like de_DE or en_US.UTF-8',
        '    locale = en_US.UTF-8',
        '    # cat=bootstrap package: language/99/50; type=string; label=Default two letter ISO code: Two letter ISO code of the default language (e.g. en)',
        '    language_isocode = en',
        '    # cat=bootstrap package: language/99/60; type=string; label=Default Language tag: Language tag defined by RFC 1766 / 3066 for "lang" and "hreflang" attributes (e.g. en-US)',
        '    hreflang = en-US',
        '    # cat=bootstrap package: language/99/70; type=options[Left to Right=ltr, Right to Left=rtl]; label=Default Language Direction: Language direction for "dir" attribute',
        '    direction = ltr',
        '}'
    ];

    /**
     * @var array
     */
    protected $setupTemplate = [
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
     * Returns the TypoScript Setup language conditions
     *
     * @return string
     */
    protected function createLanguageConditions(): string
    {
        $setup = '';
        $languages = LanguageUtility::getLanguageRows();
        foreach ($languages as $uid => $row) {
            $setup .= implode(LF, $this->setupTemplate) . LF;
            $setup = str_replace(self::SYS_LANGUAGE_UID_PLACEHOLDER, $uid, $setup);
            $setup = str_replace(self::LANGUAGE_PLACEHOLDER, $row['twoLetterIsoCode'], $setup);
            $setup = str_replace(self::LOCALE_PLACEHOLDER, $row['locale'], $setup);
            $setup = str_replace(self::HREF_LANG_PLACEHOLDER, $row['hreflang'], $setup);
            $setup = str_replace(self::DIRECTION_PLACEHOLDER, $row['direction'], $setup);
        }

        return $setup;
    }

    /**
     * Add TS language conditions to setup
     *
     * @param array $params
     * @param TemplateService $templateService
     * @return void
     */
    public function addLanguageConditions(&$params, &$templateService): void
    {
        ExtensionManagementUtility::addTypoScriptConstants(implode(LF, $this->constants));
        ExtensionManagementUtility::addTypoScriptSetup($this->createLanguageConditions());
    }
}
