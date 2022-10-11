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
 * CarouselContentElementUpdate
 */
class CarouselContentElementUpdate extends AbstractUpdate implements UpgradeWizardInterface, RepeatableInterface
{
    /**
     * @var string
     */
    protected $title = 'EXT:bootstrap_package: Migrate carousel content element';

    /**
     * @var string
     */
    protected $table = 'tt_content';

    public function updateNecessary(): bool
    {
        $queryBuilder = $this->createQueryBuilder();
        $criteria = [$this->createEqualStringCriteria($queryBuilder, 'CType', 'bootstrap_package_carousel')];
        $records = $this->getRecordsByCriteria($queryBuilder, $criteria);

        return (bool) count($records);
    }

    public function executeUpdate(): bool
    {
        $queryBuilder = $this->createQueryBuilder();
        $criteria = [$this->createEqualStringCriteria($queryBuilder, 'CType', 'bootstrap_package_carousel')];
        $records = $this->getRecordsByCriteria($queryBuilder, $criteria);

        foreach ($records as $record) {
            $this->updateRecord(
                (int) $record['uid'],
                [
                    'layout' => $this->resetLayout(intval($record['layout'])),
                    'CType' => $this->mapValues(intval($record['layout']))
                ]
            );
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

    protected function mapValues(int $layout): string
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
