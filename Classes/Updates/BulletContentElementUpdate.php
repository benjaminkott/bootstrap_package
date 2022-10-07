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
 * BulletContentElementUpdate
 */
class BulletContentElementUpdate extends AbstractUpdate implements UpgradeWizardInterface, RepeatableInterface
{
    /**
     * @var string
     */
    protected $title = 'EXT:bootstrap_package: Migrate bullet content element';

    /**
     * @var string
     */
    protected $table = 'tt_content';

    public function updateNecessary(): bool
    {
        $queryBuilder = $this->createQueryBuilder();
        $criteria = [
            $this->createEqualStringCriteria($queryBuilder, 'CType', 'bullets'),
            $this->createInCriteria($queryBuilder, 'layout', [100, 110, 120, 130]),
        ];
        $records = $this->getRecordsByCriteria($queryBuilder, $criteria);

        return (bool) count($records);
    }

    public function executeUpdate(): bool
    {
        $queryBuilder = $this->createQueryBuilder();
        $criteria = [
            $this->createEqualStringCriteria($queryBuilder, 'CType', 'bullets'),
            $this->createInCriteria($queryBuilder, 'layout', [100, 110, 120, 130]),
        ];
        $records = $this->getRecordsByCriteria($queryBuilder, $criteria);

        foreach ($records as $record) {
            $this->updateRecord(
                (int) $record['uid'],
                [
                    'layout' => (string) 0,
                    'bullets_type' => (string) $this->mapValues(intval($record['layout']))
                ]
            );
        }

        return true;
    }

    protected function mapValues(int $layout): int
    {
        $mapping = [
            110 => 1
        ];
        if (array_key_exists($layout, $mapping)) {
            return $mapping[$layout];
        }
        return 0;
    }
}
