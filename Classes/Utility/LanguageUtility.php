<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Utility;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Static utility functions for language processing
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
     * Returns the value of a TS constant and in BE mode fallback to the name
     *
     * @param int $key
     * @return string Value of the constant
     */
    protected static function getConstantValue($key)
    {
        $result = '';

        if (TYPO3_MODE == 'BE') {
            $result = '{$' . $key . '}';
        } else {
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
        if (!is_numeric($languageUid) || $languageUid < 0) {
            throw new \InvalidArgumentException('$languageUid must be a positive integer but was \'' . $languageUid . '\'.', 1522795889);
        }

        $result = [];

        if (is_array($row) && $languageUid > 0) {
            // Load language from row
            $result = $row;
        } else {
            // Load default language from constants
            $result['title'] = self::getConstantValue('config.language.default.title');
            $result['nav_title'] = self::getConstantValue('config.language.default.nav_title');
            $result['language'] = self::getConstantValue('config.language.default.language');
            $result['locale'] = self::getConstantValue('config.language.default.locale');
            $result['hreflang'] = self::getConstantValue('config.language.default.hreflang');
            $result['direction'] = self::getConstantValue('config.language.default.direction');
        }

        // Fallback to title if nav_title not set
        if (empty($result['nav_title'])) {
            $result['nav_title'] = $result['title'];
        }

        // Sanitize array
        $result = array_replace_recursive(self::$languageDefaults, $result);

        return $result;
    }

    /**
     * Returns the language data for $languageUid
     *
     * @param int $pageId
     * @param int $languageUid
     * @return array
     */
    public static function getLanguageRow($pageId, $languageUid)
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
                // Cache site finder for later calls
                static $siteFinder = null;

                if ($siteFinder === null) {
                    $siteFinder = GeneralUtility::makeInstance('TYPO3\CMS\Core\Site\SiteFinder');
                }

                static $queryBuilder = null;

                if ($siteFinder !== null) {
                    $languageRow = $siteFinder->getSiteByPageId($pageId)->getLanguageById($languageUid)->toArray();
                    /*
                    if ($queryBuilder === null) {
                        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_site_language');
                    }

                    // todo: verify query
                    $languageRow = $queryBuilder->select('uid', 'title', 'language_isocode AS language', 'locale', 'hreflang', 'direction', 'nav_title')
                        ->from('sys_site_language')
                        ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)))
                        ->execute()
                        ->fetch();
                    */
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
     * @param int $pageId
     * @return array
     */
    public static function getLanguageRows($pageId)
    {
        // Cache languages data for later calls
        static $languagesCache = null;

        if ($languagesCache === null) {
            // Prepare and fetch from database
            if (class_exists('TYPO3\CMS\Core\Site\SiteFinder')) {
                $languages = GeneralUtility::makeInstance('TYPO3\CMS\Core\Site\SiteFinder')->getSiteByPageId($pageId)->getLanguages();
                foreach($languages as $languageUid => $language) {
                    $languagesCache[$languageUid] = self::extractLanguageData($languageUid, $language);                    
                }
                /*
                $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_site_language');
                // todo: verify query
                $statement = $queryBuilder->select('uid', 'title', 'language_isocode AS language', 'locale', 'hreflang', 'direction', 'nav_title')
                    ->from('sys_site_language')
                    ->execute();
                */
            } else {
                // Set default language
                $languagesCache[0] = self::extractLanguageData(0, null);

                $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_language');
                $statement = $queryBuilder->select('uid', 'title', 'language_isocode AS language', 'locale', 'hreflang', 'direction', 'nav_title')
                    ->from('sys_language')
                    ->execute();

                while ($row = $statement->fetch()) {
                    $languagesCache[$row['uid']] = self::extractLanguageData($row['uid'], $row);
                }
            }
        }

        return $languagesCache;
    }

    /**
     * Returns a list of all languages
     *
     * @param int $pageId
     * @param string $sortingField
     * @return array List of available languages (e.g. 0,2,3)
     */
    public static function getLanguageList($pageId, $sortingField = '')
    {
        // Cache languages for later calls
        static $languageListCache = null;

        if ($languageListCache === null) {
            if (empty($sortingField)) {
                $sortingField = 'sorting';
            }

            if (class_exists('TYPO3\CMS\Core\Site\SiteFinder')) {
                $languageListCache = '';
                $languages = GeneralUtility::makeInstance('TYPO3\CMS\Core\Site\SiteFinder')->getSiteByPageId($pageId)->getLanguages();
                foreach($languages as $languageUid) {
                    $languageListCache .= (($languageListCache === '') ? '' : ',') . $languageUid;
                }

                /*
                // todo: verify query
                $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_site_language');
                $statement = $queryBuilder->select('uid')
                    ->from('sys_site_language')
                    ->orderBy($sortingField)
                    ->execute();
                */
            } else {
                // Set default language if enabled
                $languageListCache = self::getConstantValue('config.language.default.enable') ? '0' : '';

                $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_language');
                $statement = $queryBuilder->select('uid')
                    ->from('sys_language')
                    ->orderBy($sortingField)
                    ->execute();

                while ($row = $statement->fetch()) {
                    $languageListCache .= (($languageListCache === '') ? '' : ',') . $row['uid'];
                }
            }

        }

        return $languageListCache;
    }
}
