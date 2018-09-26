<?php
declare(strict_types = 1);

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
     * @param string $key
     * @return string Value of the constant
     */
    protected static function getConstantValue(string $key): string
    {
        $result = '';

        if (TYPO3_MODE === 'BE') {
            $result = '{$' . $key . '}';
        } else {
            if ($GLOBALS['TSFE']->tmpl->flatSetup === null
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
     * @param array $row
     * @return array Sanitized language data
     */
    protected static function extractLanguageData($row): array
    {
        $result = [];

        if (!empty($row)) {
            // Load language from row
            $result = $row;
        } else {
            // Load default language from constants
            $result['locale'] = self::getConstantValue('config.language.default.locale');
            $result['title'] = self::getConstantValue('config.language.default.title');
            $result['navigationTitle'] = self::getConstantValue('config.language.default.nav_title');
            $result['twoLetterIsoCode'] = self::getConstantValue('config.language.default.language_isocode');
            $result['hreflang'] = self::getConstantValue('config.language.default.hreflang');
            $result['direction'] = self::getConstantValue('config.language.default.direction');
        }
        // Fallback to title if nav_title not set
        if (empty($result['navigationTitle'])) {
            $result['navigationTitle'] = $result['title'];
        }
        // Sanitize array
        return array_replace_recursive(self::$languageDefaults, $result);
    }

    /**
     * Returns the language data for $languageUid
     *
     * @param int $languageUid
     * @return array
     */
    public static function getLanguageRow(int $languageUid): array
    {
        // Cache languages data for later calls
        static $languageCache = null;

        if ($languageCache === null || !isset($languageCache[$languageUid])) {
            $languageRow = null;
            if ($languageRow === null && ($languageUid > 0)) {
                // Prepare and fetch from database
                static $queryBuilder = null;

                if ($queryBuilder === null) {
                    $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_language');
                }
                $languageRow = $queryBuilder->select('uid AS languageId', 'locale', 'title', 'nav_title AS navigationTitle', 'language_isocode AS twoLetterIsoCode', 'hreflang', 'direction')
                    ->from('sys_language')
                    ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)))
                    ->execute()
                    ->fetch();
            }
            $languageCache[$languageUid] = self::extractLanguageData($languageRow);
        }

        return $languageCache[$languageUid];
    }

    /**
     * Returns the language data for all languages
     *
     * @return array
     */
    public static function getLanguageRows(): array
    {
        // Cache languages data for later calls
        static $languagesCache = null;

        if ($languagesCache === null) {
            // Set default language
            $languagesCache[0] = self::extractLanguageData([]);
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_language');
            $statement = $queryBuilder->select('uid AS languageId', 'locale', 'title', 'nav_title AS navigationTitle', 'language_isocode AS twoLetterIsoCode', 'hreflang', 'direction')
                ->from('sys_language')
                ->execute();
            while ($row = $statement->fetch()) {
                $languagesCache[$row['languageId']] = self::extractLanguageData($row);
            }
        }

        return $languagesCache;
    }

    /**
     * Returns a list of all languages
     *
     * @return string List of available languages (e.g. 0,2,3)
     */
    public static function getLanguageList(): string
    {
        // Cache languages for later calls
        static $languageListCache = null;

        if ($languageListCache === null) {
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
