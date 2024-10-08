<?php
declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Updates;

use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\RepeatableInterface;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

#[UpgradeWizard(FrameClassToBackgroundUpdate::class)]
class FrameClassToBackgroundUpdate extends AbstractUpdate implements UpgradeWizardInterface, RepeatableInterface
{
    /**
     * @var string
     */
    protected $title = 'EXT:bootstrap_package: Migrate obsolete frame_class options to background color';

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
        'well' => 'light',
        'jumbotron' => 'primary',
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
            if (null !== $newValue = $this->mapValues(strval($record[$this->field]))) {
                $this->updateRecord(
                    (int) $record['uid'],
                    [
                        $this->field => 'default',
                        'background_color_class' => $newValue,
                    ]
                );
            }
        }

        return true;
    }

    protected function mapValues(string $value): ?string
    {
        if (array_key_exists($value, $this->mapping)) {
            return $this->mapping[$value];
        }
        return null;
    }
}
