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
 * FrameClassUpdate
 */
class FrameClassUpdate extends AbstractUpdate implements UpgradeWizardInterface, RepeatableInterface
{
    /**
     * @var string
     */
    protected $title = 'EXT:bootstrap_package: Migrate the field "section_frame" for all content elements to "frame_class"';

    /**
     * @var string
     */
    protected $table = 'tt_content';

    public function updateNecessary(): bool
    {
        if (!$this->tableHasColumn('section_frame')) {
            return false;
        }

        $queryBuilder = $this->createQueryBuilder();
        $criteria = [$this->createCreaterThanCriteria($queryBuilder, 'section_frame', 0)];
        $records = $this->getRecordsByCriteria($queryBuilder, $criteria);

        return (bool) count($records);
    }

    public function executeUpdate(): bool
    {
        $queryBuilder = $this->createQueryBuilder();
        $criteria = [$this->createCreaterThanCriteria($queryBuilder, 'section_frame', 0)];
        $records = $this->getRecordsByCriteria($queryBuilder, $criteria);

        foreach ($records as $record) {
            $this->updateRecord(
                (int) $record['uid'],
                [
                    'section_frame' => '0',
                    'frame_class' => $this->mapSectionFrame(intval($record['section_frame']))
                ]
            );
        }

        return true;
    }

    protected function mapSectionFrame(int $sectionFrame): string
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
