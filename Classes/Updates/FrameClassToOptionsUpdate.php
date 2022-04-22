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
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\RepeatableInterface;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

/**
 * FrameClassToOptionsUpdate
 */
class FrameClassToOptionsUpdate implements UpgradeWizardInterface, RepeatableInterface
{
    /**
     * @var string
     */
    protected $table = 'tt_content';

    /**
     * @var string
     */
    protected $field = 'frame_class';

    /**
     * @var array
     */
    protected $mapping = [
        'ruler-before' => 'ruler-before',
        'ruler-after' => 'ruler-after',
        'indent' => 'indent-left,indent-right',
        'indent-left' => 'indent-left',
        'indent-right' => 'indent-right'
    ];

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
        return '[Bootstrap Package] Migrate obsolete frame_class options to frame options';
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
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($this->table);
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));
        /** @var Result $result */
        $result = $queryBuilder->count('uid')
            ->from($this->table)
            ->where(
                $queryBuilder->expr()->in(
                    $this->field,
                    $queryBuilder->createNamedParameter(
                        array_keys($this->mapping),
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
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable($this->table);
        $queryBuilder = $connection->createQueryBuilder();
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));
        /** @var Result $result */
        $result = $queryBuilder->select('uid', $this->field)
            ->from($this->table)
            ->where(
                $queryBuilder->expr()->in(
                    $this->field,
                    $queryBuilder->createNamedParameter(
                        array_keys($this->mapping),
                        Connection::PARAM_STR_ARRAY
                    )
                )
            )
            ->execute();
        while ($record = $result->fetchAssociative()) {
            if (null !== $newValue = $this->mapValues($record[$this->field])) {
                $queryBuilder = $connection->createQueryBuilder();
                $queryBuilder->update($this->table)
                    ->where(
                        $queryBuilder->expr()->eq(
                            'uid',
                            $queryBuilder->createNamedParameter($record['uid'], \PDO::PARAM_INT)
                        )
                    )
                    ->set($this->field, 'default')
                    ->set('frame_options', $newValue);
                $queryBuilder->execute();
            }
        }
        return true;
    }

    /**
     * @param string|int $value
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
