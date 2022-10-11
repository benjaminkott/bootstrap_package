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
 * TabMediaOrientUpdate
 */
class TabMediaOrientUpdate extends AbstractUpdate implements UpgradeWizardInterface, RepeatableInterface
{
    /**
     * @var string
     */
    protected $title = 'EXT:bootstrap_package: Migrate media orientation of tab content element';

    /**
     * @var string
     */
    protected $table = 'tx_bootstrappackage_tab_item';

    /**
     * @var string
     */
    protected $field = 'mediaorient';

    /**
     * @var array
     */
    protected $mapping = [
        0 => 'left',
        1 => 'right'
    ];

    public function updateNecessary(): bool
    {
        $queryBuilder = $this->createQueryBuilder();
        $criteria = [$this->createInCriteria($queryBuilder, $this->field, array_keys($this->mapping))];
        $records = $this->getRecordsByCriteria($queryBuilder, $criteria);

        return (bool) count($records);
    }

    public function executeUpdate(): bool
    {
        $queryBuilder = $this->createQueryBuilder();
        $criteria = [$this->createInCriteria($queryBuilder, $this->field, array_keys($this->mapping))];
        $records = $this->getRecordsByCriteria($queryBuilder, $criteria);

        foreach ($records as $record) {
            if (null !== $newValue = $this->mapValues(intval($record[$this->field]))) {
                $this->updateRecord(
                    (int) $record['uid'],
                    [$this->field => $newValue]
                );
            }
        }

        return true;
    }

    protected function mapValues(int $value): ?string
    {
        if (array_key_exists($value, $this->mapping)) {
            return $this->mapping[$value];
        }
        return null;
    }
}
