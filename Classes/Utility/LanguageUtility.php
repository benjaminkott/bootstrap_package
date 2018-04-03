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
     * @var array
     */
    public static $languageDefaults = [
        'title' => '',
        'nav_title' => '',
        'language' => '',
        'locale' => '',
        'hreflang' => '',
        'direction' => ''
    ];

    /**
     * Returns the value of a TS constant
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
     * Extract the language data from the row or constants
     *
     * @param int $languageUid
     * @param array $row
     * @return array Sanitized language data
     */
    protected static function extractLanguageData($languageUid, $row)
    {
        $result = [];

        if (is_numeric($languageUid)) {
            if (is_array($row) && $languageUid > 0) {
                // Load language from row
                $result = $row;
            } else {
                // Load default language from constants
                $result['title'] = self::getConstantValue('page.language.defaultTitle');
                $result['nav_title'] = self::getConstantValue('page.language.defaultNavigationTitle');
                $result['language'] = self::getConstantValue('page.language.defaultLanguage');
                $result['locale'] = self::getConstantValue('page.language.defaultLocale');
                $result['hreflang'] = self::getConstantValue('page.language.defaultHreflang');
                $result['direction'] = self::getConstantValue('page.language.defaultDirection');
            }

            // Take nav_title from title if not set
            if (empty($result['nav_title'])) {
                $result['nav_title'] = $result['title'];
            }

            // Sanitize array
            //$result = array_replace_recursive(self::$languageDefaults, $result);
        }

        return $result;
    }

    /**
     * Returns the language data for the languageUid
     *
     * @param int $languageUid
     * @return array
     */
    public static function getLanguageRow($languageUid)
    {
        if (!is_numeric($languageUid) || $languageUid < 0) {
            throw new \InvalidArgumentException('$languageUid must be a positive integer but was \'' . $languageUid . '\'.', 1522602868);
        }

        // Cache languages data for later calls
        static $languageCache = null;

        if ($languageCache === null || !isset($languageCache[$languageUid])) {
            $languageRow = null;

            // Prepare and fetch from database
            if ($languageUid > 0) {
                // Cache state for later calls
                static $hasSites = null;

                if ($hasSites === null) {
                    $hasSites = ExtensionManagementUtility::isLoaded('sites');
                }

                static $queryBuilder = null;

                if ($hasSites) {
                    if ($queryBuilder === null) {
                        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_site_language');
                    }

                    // todo: verify query
                    $languageRow = $queryBuilder->select('uid', 'title', 'language_isocode AS language', 'locale', 'hreflang', 'direction', 'nav_title')
                        ->from('sys_site_language')
                        ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)))
                        ->execute()
                        ->fetch();
                } else {
                    if ($queryBuilder === null) {
                        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_language');
                    }

                    $languageRow = $queryBuilder->select('uid', 'title', 'language_isocode AS language', 'locale', 'hreflang', 'direction', 'nav_title')
                        ->from('sys_language')
                        ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)))
                        ->execute()
                        ->fetch();
                }
            }

            $languageCache[$languageUid] = self::extractLanguageData($languageUid, $languageRow);
        }

        return $languageCache[$languageUid];
    }

    /**
     * Returns the language data for all languages
     *
     * @return array
     */
    public static function getLanguageRows()
    {
        // Cache languages data for later calls
        static $languagesCache = null;

        if ($languagesCache === null) {
            // Prepare and fetch from database
            if (ExtensionManagementUtility::isLoaded('sites')) {
                $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_site_language');
                // todo: verify query
                $statement = $queryBuilder->select('uid', 'title', 'language_isocode AS language', 'locale', 'hreflang', 'direction', 'nav_title')
                    ->from('sys_site_language')
                    ->execute();
            } else {
                // Set default language
                $languagesCache[0] = self::extractLanguageData(0, null);

                $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_language');
                $statement = $queryBuilder->select('uid', 'title', 'language_isocode AS language', 'locale', 'hreflang', 'direction', 'nav_title')
                    ->from('sys_language')
                    ->execute();
            }

            while ($row = $statement->fetch()) {
                $languagesCache[$row['uid']] = self::extractLanguageData($row['uid'], $row);
            }
        }

        return $languagesCache;
    }

    /**
     * Returns a list of all languages
     *
     * @return array List of available languages (e.g. 0,2,3)
     */
    public static function getLanguageList()
    {
        // Cache languages for later calls
        static $languageListCache = null;

        // todo: include correct sorting
        if ($languageListCache === null) {
            if (ExtensionManagementUtility::isLoaded('sites')) {
                $languageListCache = '';

                // todo: verify query
                $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_site_language');
                $statement = $queryBuilder->select('uid')
                    ->from('sys_site_language')
                    ->execute();
            } else {
                // Set default language
                $languageListCache = '0';

                $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_language');
                $statement = $queryBuilder->select('uid')
                    ->from('sys_language')
                    ->execute();
            }

            while ($row = $statement->fetch()) {
                $languageListCache .= (($languageListCache === '') ? '' : ',') . $row['uid'];
            }
        }

        return $languageListCache;
    }
}
