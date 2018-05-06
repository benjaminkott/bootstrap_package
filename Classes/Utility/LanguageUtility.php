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
        'languageId' => '',
        'locale' => '',
        'title' => '',
        'navigationTitle' => '',
        'twoLetterIsoCode' => '',
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

        if (isset($row) && is_array($row)) {
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

        if (!isset($languageCache) || !isset($languageCache[$languageUid])) {
            $languageRow = null;

            if (!isset($languageRow) && ($languageUid > 0)) {
                // Prepare and fetch from database
                static $queryBuilder = null;

                if (!isset($queryBuilder)) {
                    $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_language');
                }
                $languageRow = $queryBuilder->select('uid AS languageId', 'locale', 'title', 'nav_title AS navigationTitle', 'language_isocode AS twoLetterIsoCode', 'hreflang', 'direction')
                    ->from('sys_language')
                    ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)))
                    ->execute()
                    ->fetch();
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

        if (!isset($languagesCache)) {
            // Set default language
            $languagesCache[0] = self::extractLanguageData(0, null);

            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_language');
            $statement = $queryBuilder->select('uid AS languageId', 'locale', 'title', 'nav_title AS navigationTitle', 'language_isocode AS twoLetterIsoCode', 'hreflang', 'direction')
                ->from('sys_language')
                ->execute();

            while ($row = $statement->fetch()) {
                $languagesCache[$row['languageId']] = self::extractLanguageData($row['languageId'], $row);
            }
        }

        return $languagesCache;
    }

    /**
     * Returns a list of all languages
     *
     * @param int $pageId
     * @return array List of available languages (e.g. 0,2,3)
     */
    public static function getLanguageList($pageId)
    {
        // Cache languages for later calls
        static $languageListCache = null;

        if (!isset($languageListCache)) {
            // Set default language if enabled
            $languageListCache = self::getConstantValue('config.language.default.enable') ? '0' : '';
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_language');
            $statement = $queryBuilder->select('uid')
                ->from('sys_language')
                ->execute();
            while ($row = $statement->fetch()) {
                $languageListCache .= (($languageListCache === '') ? '' : ',') . $row['uid'];
            }
        }

        return $languageListCache;
    }
}
