<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Updates;

use Doctrine\DBAL\ForwardCompatibility\Result;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\RepeatableInterface;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

/**
 * CarouselItemTypeUpdate
 */
class CarouselItemTypeUpdate implements UpgradeWizardInterface, RepeatableInterface
{
    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return self::class;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return '[Bootstrap Package] Migrate carousel item types';
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return '';
    }

    /**
     * @return string[]
     */
    public function getPrerequisites(): array
    {
        return [
            DatabaseUpdatedPrerequisite::class
        ];
    }

    /**
     * @return bool
     */
    public function updateNecessary(): bool
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_bootstrappackage_carousel_item');
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));
        /** @var Result $result */
        $result = $queryBuilder->count('uid')
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
        return (bool) $result->fetchOne();
    }

    /**
     * @return bool
     */
    public function executeUpdate(): bool
    {
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_bootstrappackage_carousel_item');
        $queryBuilder = $connection->createQueryBuilder();
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));
        /** @var Result $result */
        $result = $queryBuilder->select('uid', 'item_type')
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
        while ($record = $result->fetchAssociative()) {
            $queryBuilder = $connection->createQueryBuilder();
            $queryBuilder->update('tx_bootstrappackage_carousel_item')
                ->where(
                    $queryBuilder->expr()->eq(
                        'uid',
                        $queryBuilder->createNamedParameter($record['uid'], \PDO::PARAM_INT)
                    )
                )
                ->set('item_type', $this->mapValues($record['item_type']));
            $queryBuilder->execute();
        }
        return true;
    }

    /**
     * @param string $type
     * @return string
     */
    protected function mapValues(string $type)
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
