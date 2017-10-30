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
 * CarouselItemTypeUpdate
 */
class CarouselItemTypeUpdate extends \TYPO3\CMS\Install\Updates\AbstractUpdate
{
    /**
     * @var string
     */
    protected $title = '[BootstrapPackage] Migrate carousel item types';

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
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_bootstrappackage_carousel_item');
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));
        $elementCount = $queryBuilder->count('uid')
            ->from('tx_bootstrappackage_carousel_item')
            ->where(
                $queryBuilder->expr()->in(
                    'item_type',
                    $queryBuilder->createNamedParameter(
                        ['textandimage', 'backgroundimage'],
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
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_bootstrappackage_carousel_item');
        $queryBuilder = $connection->createQueryBuilder();
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));
        $statement = $queryBuilder->select('uid', 'item_type')
            ->from('tx_bootstrappackage_carousel_item')
            ->where(
                $queryBuilder->expr()->in(
                    'item_type',
                    $queryBuilder->createNamedParameter(
                        ['textandimage', 'backgroundimage'],
                        Connection::PARAM_STR_ARRAY
                    )
                )
            )
            ->execute();
        while ($record = $statement->fetch()) {
            $queryBuilder = $connection->createQueryBuilder();
            $queryBuilder->update('tx_bootstrappackage_carousel_item')
                ->where(
                    $queryBuilder->expr()->eq(
                        'uid',
                        $queryBuilder->createNamedParameter($record['uid'], \PDO::PARAM_INT)
                    )
                )
                ->set('item_type', $this->mapValues($record['item_type']));
            $databaseQueries[] = $queryBuilder->getSQL();
            $queryBuilder->execute();
        }
        $this->markWizardAsDone();
        return true;
    }

    /**
     * Map the old to the new values
     *
     * @param int $type
     * @return string
     */
    protected function mapValues($type)
    {
        $mapping = [
            'textandimage' => 'text_and_image',
            'backgroundimage' => 'background_image'
        ];
        if (array_key_exists($type, $mapping)) {
            return $mapping[$type];
        }
        return 'header';
    }
}
