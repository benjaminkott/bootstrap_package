<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Utility;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * LanguageUtility
 */
class LanguageUtility
{
    /**
     * Gets the value of a TS constant
     *
     * @param int $key
     * @return string Value of the constant
     */
    protected static function getConstantValue($key)
    {
        $result = '';
        if (!isset($GLOBALS['TSFE']->tmpl->flatSetup)
            || !is_array($GLOBALS['TSFE']->tmpl->flatSetup)
            || count($GLOBALS['TSFE']->tmpl->flatSetup) === 0) {
            $GLOBALS['TSFE']->tmpl->generateConfig();
        }
        foreach ($GLOBALS['TSFE']->tmpl->flatSetup as $constant => $value) {
            if (strpos($constant, $key) === 0) {
                $result = $value;
                break;
            }
        }
        return $result;
    }

    /**
     * Gets the language data for the languageUid
     *
     * @param int $languageUid
     * @return string JSON encoded data
     */
    public static function getLanguageData($languageUid)
    {
        static $languageData = null;

        if ($languageData === null || !isset($languageData[$languageUid])) {
            if ((is_numeric($languageUid)) && $languageUid > 0) {
                static $hasSites = null;

                if ($hasSites === null) {
                    $hasSites = ExtensionManagementUtility::isLoaded('sites');
                }

                static $queryBuilder = null;

                if ($hasSites) {
                    if ($queryBuilder === null) {
                        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_site_language');
                    }

                    $language = null;
                /*
                $language = $queryBuilder->select('title', 'language_isocode AS language', 'locale', 'hreflang', 'direction', 'nav_title AS localized_title')
                    ->from('sys_site_language')
                    ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)))
                    ->execute()
                    ->fetch();

                if (is_array($language)) {
                    // Fetch default language
                    $language = $queryBuilder->select('title', 'language_isocode AS language', 'locale', 'hreflang', 'direction', 'nav_title AS localized_title')
                        ->from('sys_site_language')
                        ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)))
                        ->execute()
                        ->fetch();
                }
                */
                } else {
                    if ($queryBuilder === null) {
                        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_language');
                    }

                    $language = $queryBuilder->select('title', 'language_isocode AS language', 'locale', 'hreflang', 'direction', 'nav_title AS localized_title')
                        ->from('sys_language')
                        ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)))
                        ->execute()
                        ->fetch();
                }

                if (is_array($language)) {
                    $languageData[$languageUid] = $language;
                }
            }

            if (!isset($languageData[$languageUid])) {
                $languageData[$languageUid]['title'] = self::getConstantValue('page.theme.language.defaultTitle');
                $languageData[$languageUid]['localized_title'] = self::getConstantValue('page.theme.language.defaultLocalizedTitle');
                $languageData[$languageUid]['language'] = self::getConstantValue('page.theme.language.defaultLanguage');
                $languageData[$languageUid]['locale'] = self::getConstantValue('page.theme.language.defaultLocale');
                $languageData[$languageUid]['hreflang'] = self::getConstantValue('page.theme.language.defaultHreflang');
                $languageData[$languageUid]['direction'] = self::getConstantValue('page.theme.language.defaultDirection');
            }

            if (empty($languageData[$languageUid]['localized_title'])) {
                $languageData[$languageUid]['localized_title'] = $languageData[$languageUid]['title'];
            }
        }

        return $languageData[$languageUid];
    }
}
