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
 * CarouselItemTypeUpdate
 */
class CarouselItemTypeUpdate extends AbstractUpdate implements UpgradeWizardInterface, RepeatableInterface
{
    /**
     * @var string
     */
    protected $title = 'EXT:bootstrap_package: Migrate carousel item types';

    /**
     * @var string
     */
    protected $table = 'tx_bootstrappackage_carousel_item';

    public function updateNecessary(): bool
    {
        $queryBuilder = $this->createQueryBuilder();
        $criteria = [$this->createInCriteria($queryBuilder, 'item_type', ['textandimage', 'backgroundimage'])];
        $records = $this->getRecordsByCriteria($queryBuilder, $criteria);

        return (bool) count($records);
    }

    public function executeUpdate(): bool
    {
        $queryBuilder = $this->createQueryBuilder();
        $criteria = [$this->createInCriteria($queryBuilder, 'item_type', ['textandimage', 'backgroundimage'])];
        $records = $this->getRecordsByCriteria($queryBuilder, $criteria);

        foreach ($records as $record) {
            $this->updateRecord(
                (int) $record['uid'],
                ['item_type' => $this->mapValues(strval($record['item_type']))]
            );
        }

        return true;
    }

    protected function mapValues(string $type): string
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
