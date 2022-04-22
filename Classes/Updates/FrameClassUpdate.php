<?php
declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Updates;

use Doctrine\DBAL\ForwardCompatibility\Result;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\RepeatableInterface;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

/**
 * FrameClassUpdate
 */
class FrameClassUpdate implements UpgradeWizardInterface, RepeatableInterface
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
        return '[Bootstrap Package] Migrate the field "section_frame" for all content elements to "frame_class"';
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
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tt_content');
        $tableColumns = $connection->getSchemaManager()->listTableColumns('tt_content');
        // Only proceed if section_frame field still exists
        if (!isset($tableColumns['section_frame'])) {
            return false;
        }
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
        $queryBuilder->getRestrictions()->removeAll();
        /** @var Result $result */
        $result = $queryBuilder->count('uid')
            ->from('tt_content')
            ->where(
                $queryBuilder->expr()->gt('section_frame', 0)
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
        $queryBuilder->getRestrictions()->removeAll();
        /** @var Result $result */
        $result = $queryBuilder->select('uid', 'section_frame')
            ->from('tt_content')
            ->where(
                $queryBuilder->expr()->gt('section_frame', 0)
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
                ->set('section_frame', '0', false)
                ->set('frame_class', $this->mapSectionFrame($record['section_frame']));
            $queryBuilder->execute();
        }
        return true;
    }

    /**
     * @param int $sectionFrame
     * @return string
     */
    protected function mapSectionFrame(int $sectionFrame)
    {
        $mapping = [
            0 => 'default',
            5 => 'ruler-before',
            6 => 'ruler-after',
            10 => 'indent',
            11 => 'indent-left',
            12 => 'indent-right',
            20 => 'well',
            21 => 'jumbotron',
            66 => 'none'
        ];
        if (array_key_exists($sectionFrame, $mapping)) {
            return $mapping[$sectionFrame];
        }
        return 'custom-' . $sectionFrame;
    }
}
