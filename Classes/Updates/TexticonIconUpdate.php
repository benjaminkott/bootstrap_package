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
 * TexticonIconUpdate
 */
class TexticonIconUpdate extends \TYPO3\CMS\Install\Updates\AbstractUpdate
{
    /**
     * @var string
     */
    protected $title = '[BootstrapPackage] Migrate text and icon identifier and name';

    /**
     * @var string
     */
    protected $table = 'tt_content';

    /**
     * @var string
     */
    protected $field = 'icon';

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
            ->orWhere(
                $queryBuilder->expr()->like(
                    $this->field,
                    $queryBuilder->expr()->literal('Glyphicons%')
                ),
                $queryBuilder->expr()->like(
                    $this->field,
                    $queryBuilder->expr()->literal('Ionicons%')
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
        $statement = $queryBuilder->select('uid', $this->field)
            ->from($this->table)
            ->orWhere(
                $queryBuilder->expr()->like(
                    $this->field,
                    $queryBuilder->expr()->literal('Glyphicons%')
                ),
                $queryBuilder->expr()->like(
                    $this->field,
                    $queryBuilder->expr()->literal('Ionicons%')
                )
            )
            ->execute();
        while ($record = $statement->fetch()) {
            $icon = explode('__', $record[$this->field]);
            $queryBuilder = $connection->createQueryBuilder();
            $queryBuilder->update($this->table)
                ->where(
                    $queryBuilder->expr()->eq(
                        'uid',
                        $queryBuilder->createNamedParameter($record['uid'], \PDO::PARAM_INT)
                    )
                )
                ->set(
                    'icon_set',
                    'EXT:bootstrap_package/Resources/Public/Images/Icons/' . $icon[0] . '/'
                )
                ->set(
                    $this->field,
                    'EXT:bootstrap_package/Resources/Public/Images/Icons/' . $icon[0] . '/' . $icon[1] . '.svg'
                );
            $databaseQueries[] = $queryBuilder->getSQL();
            $queryBuilder->execute();
        }
        $this->markWizardAsDone();
        return true;
    }
}
