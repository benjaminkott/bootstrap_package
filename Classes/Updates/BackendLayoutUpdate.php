<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Updates;

use TYPO3\CMS\Install\Updates\RepeatableInterface;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

/**
 * BackendLayoutUpdate
 */
class BackendLayoutUpdate extends AbstractUpdate implements UpgradeWizardInterface, RepeatableInterface
{
    /**
     * @var string
     */
    protected $title = 'EXT:bootstrap_package: Migrate backend layouts';

    /**
     * @var string
     */
    protected $table = 'pages';

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

    public function updateNecessary(): bool
    {
        $queryBuilder = $this->createQueryBuilder();
        $criteria = [
            $this->createInCriteria($queryBuilder, 'backend_layout', array_keys($this->mapping)),
            $this->createInCriteria($queryBuilder, 'backend_layout_next_level', array_keys($this->mapping)),
        ];
        $records = $this->getRecordsByCriteria($queryBuilder, $criteria, AbstractUpdate::CONDITION_OR);

        return (bool) count($records);
    }

    public function executeUpdate(): bool
    {
        $queryBuilder = $this->createQueryBuilder();
        $criteria = [
            $this->createInCriteria($queryBuilder, 'backend_layout', array_keys($this->mapping)),
            $this->createInCriteria($queryBuilder, 'backend_layout_next_level', array_keys($this->mapping)),
        ];
        $records = $this->getRecordsByCriteria($queryBuilder, $criteria, AbstractUpdate::CONDITION_OR);

        foreach ($records as $record) {
            $this->updateRecord(
                (int) $record['uid'],
                [
                    'backend_layout' => $this->mapValues(strval($record['backend_layout'])),
                    'backend_layout_next_level' => $this->mapValues(strval($record['backend_layout_next_level']))
                ]
            );
        }

        return true;
    }

    protected function mapValues(string $value): string
    {
        if (array_key_exists($value, $this->mapping)) {
            return $this->mapping[$value];
        }
        return $value;
    }
}
