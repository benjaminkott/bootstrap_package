<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Updates;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * BackendLayoutUpdate
 */
class BackendLayoutUpdate extends \TYPO3\CMS\Install\Updates\AbstractUpdate
{
    /**
     * @var string
     */
    protected $title = '[BootstrapPackage] Migrate Backend Layouts';

    /**
     * @var string
     */
    protected $table = 'pages';

    /**
     * @var string
     */
    protected $field = 'backend_layout';

    /**
     * @var array
     */
    protected $mapping = [
        'pagets__clean' => 'pagets__simple',
        'pagets__default_clean' => 'pagets__simple',
        'pagets__default_2_columns' => 'pagets__2_columns',
        'pagets__default_2_columns_25_75' => 'pagets__2_columns_25_75',
        'pagets__default_2_columns_50_50' => 'pagets__2_columns_50_50',
        'pagets__default_2_columns_offset_right' => 'pagets__2_columns_offset_right',
        'pagets__default_3_columns' => 'pagets__3_columns',
        'pagets__default_subnavigation_right' => 'pagets__subnavigation_right',
        'pagets__default_subnavigation_right_2_columns' => 'pagets__subnavigation_right_2_columns',
        'pagets__default_subnavigation_left' => 'pagets__subnavigation_left',
        'pagets__default_subnavigation_left_2_columns' => 'pagets__subnavigation_left_2_columns'
    ];

    /**
     * Checks if an update is needed
     *
     * @param string &$description The description for the update
     *
     * @return bool Whether an update is needed (TRUE) or not (FALSE)
     */
    public function checkForUpdate(&$description)
    {
        if ($this->isWizardDone()) {
            return false;
        }
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($this->table);
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));
        $elementCount = $queryBuilder->count('uid')
            ->from($this->table)
            ->where(
                $queryBuilder->expr()->in(
                    'backend_layout',
                    $queryBuilder->createNamedParameter(
                        array_keys($this->mapping),
                        Connection::PARAM_STR_ARRAY
                    )
                )
            )
            ->orWhere(
                $queryBuilder->expr()->in(
                    'backend_layout_next_level',
                    $queryBuilder->createNamedParameter(
                        array_keys($this->mapping),
                        Connection::PARAM_STR_ARRAY
                    )
                )
            )
            ->execute()->fetchColumn(0);
        return (bool)$elementCount;
    }

    /**
     * Performs the database update
     *
     * @param array &$databaseQueries Queries done in this update
     * @param string &$customMessage Custom message
     * @return bool
     */
    public function performUpdate(array &$databaseQueries, &$customMessage)
    {
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable($this->table);
        $queryBuilder = $connection->createQueryBuilder();
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));
        $statement = $queryBuilder->select('uid', 'backend_layout', 'backend_layout_next_level')
            ->from($this->table)
            ->where(
                $queryBuilder->expr()->in(
                    'backend_layout',
                    $queryBuilder->createNamedParameter(
                        array_keys($this->mapping),
                        Connection::PARAM_STR_ARRAY
                    )
                )
            )
            ->orWhere(
                $queryBuilder->expr()->in(
                    'backend_layout_next_level',
                    $queryBuilder->createNamedParameter(
                        array_keys($this->mapping),
                        Connection::PARAM_STR_ARRAY
                    )
                )
            )
            ->execute();
        while ($record = $statement->fetch()) {
            $queryBuilder = $connection->createQueryBuilder();
            $queryBuilder->update($this->table)
                ->where(
                    $queryBuilder->expr()->eq(
                        'uid',
                        $queryBuilder->createNamedParameter($record['uid'], \PDO::PARAM_INT)
                    )
                )
                ->set(
                    'backend_layout',
                    ($this->mapValues($record['backend_layout']) ?: $record['backend_layout'])
                )
                ->set(
                    'backend_layout_next_level',
                    ($this->mapValues($record['backend_layout_next_level']) ?: $record['backend_layout_next_level'])
                );
            $databaseQueries[] = $queryBuilder->getSQL();
            $queryBuilder->execute();
        }
        $this->markWizardAsDone();
        return true;
    }

    /**
     * Map the old to the new values
     *
     * @param int $value
     * @return string|null
     */
    protected function mapValues($value)
    {
        if (array_key_exists($value, $this->mapping)) {
            return $this->mapping[$value];
        }
        return null;
    }
}
