<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Updates;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * TableContentElementUpdate
 */
class TableContentElementUpdate extends ForcedUpdate
{
    /**
     * @var string
     */
    protected $title = '[BootstrapPackage] Migrate table content element';

    /**
     * Checks if an update is needed
     *
     * @param string &$description The description for the update
     * @return bool Whether an update is needed (TRUE) or not (FALSE)
     */
    public function checkForUpdate(&$description)
    {
        if ($this->isWizardDone()) {
            return false;
        }
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));
        $elementCount = $queryBuilder->count('uid')
            ->from('tt_content')
            ->where(
                $queryBuilder->expr()->eq('CType', $queryBuilder->createNamedParameter('table', \PDO::PARAM_STR)),
                $queryBuilder->expr()->in('layout', [100, 110, 120, 130, 140, 150])
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
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tt_content');
        $queryBuilder = $connection->createQueryBuilder();
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));
        $statement = $queryBuilder->select('uid', 'layout')
            ->from('tt_content')
            ->where(
                $queryBuilder->expr()->eq('CType', $queryBuilder->createNamedParameter('table', \PDO::PARAM_STR)),
                $queryBuilder->expr()->in('layout', [100, 110, 120, 130, 140, 150])
            )
            ->execute();
        while ($record = $statement->fetch()) {
            $queryBuilder = $connection->createQueryBuilder();
            $queryBuilder->update('tt_content')
                ->where(
                    $queryBuilder->expr()->eq(
                        'uid',
                        $queryBuilder->createNamedParameter($record['uid'], \PDO::PARAM_INT)
                    )
                )
                ->set('layout', 0, false)
                ->set('table_class', $this->mapValues($record['layout']));
            $databaseQueries[] = $queryBuilder->getSQL();
            $queryBuilder->execute();
        }
        $this->markWizardAsDone();
        return true;
    }

    /**
     * Map the old to the new values
     *
     * @param int $layout
     * @return string
     */
    protected function mapValues($layout)
    {
        $mapping = [
            100 => '',
            110 => '',
            120 => 'striped',
            130 => 'bordered',
            140 => 'hover',
            150 => 'condensed',
        ];
        return $mapping[$layout];
    }
}
