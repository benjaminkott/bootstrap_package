<?php
declare(strict_types=1);

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
 * TableContentElementUpdate
 */
class TableContentElementUpdate extends AbstractUpdate implements UpgradeWizardInterface, RepeatableInterface
{
    /**
     * @var string
     */
    protected $title = 'EXT:bootstrap_package: Migrate table content element';

    /**
     * @var string
     */
    protected $table = 'tt_content';

    public function updateNecessary(): bool
    {
        $queryBuilder = $this->createQueryBuilder();
        $criteria = [
            $this->createEqualStringCriteria($queryBuilder, 'CType', 'table'),
            $this->createInCriteria($queryBuilder, 'layout', [100, 110, 120, 130, 140, 150]),
        ];
        $records = $this->getRecordsByCriteria($queryBuilder, $criteria);

        return (bool) count($records);
    }

    public function executeUpdate(): bool
    {
        $queryBuilder = $this->createQueryBuilder();
        $criteria = [
            $this->createEqualStringCriteria($queryBuilder, 'CType', 'table'),
            $this->createInCriteria($queryBuilder, 'layout', [100, 110, 120, 130, 140, 150]),
        ];
        $records = $this->getRecordsByCriteria($queryBuilder, $criteria);

        foreach ($records as $record) {
            $this->updateRecord(
                (int) $record['uid'],
                [
                    'layout' => '0',
                    'table_class' => $this->mapValues(intval($record['layout']))
                ]
            );
        }

        return true;
    }

    protected function mapValues(int $layout): string
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
