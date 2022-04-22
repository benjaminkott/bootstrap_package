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
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\RepeatableInterface;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

/**
 * CarouselContentElementUpdate
 */
class CarouselContentElementUpdate implements UpgradeWizardInterface, RepeatableInterface
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
        return '[Bootstrap Package] Migrate carousel content element';
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
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));
        /** @var Result $result */
        $result = $queryBuilder->count('uid')
            ->from('tt_content')
            ->where(
                $queryBuilder->expr()->eq('CType', $queryBuilder->createNamedParameter('bootstrap_package_carousel', \PDO::PARAM_STR))
            )
            ->execute();
        return (bool) $result->fetchOne();
    }

    /**
     * @return bool
     */
    public function executeUpdate(): bool
    {
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tt_content');
        $queryBuilder = $connection->createQueryBuilder();
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));
        /** @var Result $result */
        $result = $queryBuilder->select('uid', 'layout')
            ->from('tt_content')
            ->where(
                $queryBuilder->expr()->eq('CType', $queryBuilder->createNamedParameter('bootstrap_package_carousel', \PDO::PARAM_STR))
            )
            ->execute();
        while ($record = $result->fetchAssociative()) {
            $queryBuilder = $connection->createQueryBuilder();
            $queryBuilder->update('tt_content')
                ->where(
                    $queryBuilder->expr()->eq(
                        'uid',
                        $queryBuilder->createNamedParameter($record['uid'], \PDO::PARAM_INT)
                    )
                )
                ->set('layout', $this->resetLayout($record['layout']), false)
                ->set('CType', $this->mapValues($record['layout']));
            $queryBuilder->execute();
        }
        return true;
    }

    protected function resetLayout(int $layout): string
    {
        if (in_array($layout, [100, 110, 120], true)) {
            return '0';
        }
        return (string)$layout;
    }

    /**
     * @param int $layout
     * @return string
     */
    protected function mapValues($layout)
    {
        $mapping = [
            110 => 'carousel_small',
            120 => 'carousel_fullscreen'
        ];
        if (array_key_exists($layout, $mapping)) {
            return $mapping[$layout];
        }
        return 'carousel';
    }
}
