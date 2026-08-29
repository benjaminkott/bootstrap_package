<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\SiteCreator\Dto;

/**
 * AbstractEntity
 */
abstract class AbstractEntity
{
    protected string $table;
    protected ?string $parentStorage = null;

    public string $id;
    public ?Page $parent = null;
    public array $parameterBag = [];

    public function __construct(string $id = null)
    {
        if (!isset($this->table)) {
            throw new \RuntimeException('Extending Entity needs to set $table.', 1622491079);
        }
        $this->id = $id ?? uniqid('NEW_CONTENT');
    }

    public function toDataHandler(): array
    {
        if ($this->parent !== null) {
            $this->parameterBag['pid'] = $this->parent->id;
            if ($this->parentStorage !== null) {
                $key = array_search($this, $this->parent->{$this->parentStorage}, true);
                if ($key !== 0) {
                    $this->parameterBag['pid'] = '-' . $this->parent->{$this->parentStorage}[((int) $key - 1)]->id;
                }
            }
        } else {
            $this->parameterBag['pid'] = 0;
        }

        $relations = $this->getDataHandlerRelations();

        $data = [];
        $data[$this->table][$this->id] = $this->parameterBag;

        return array_merge_recursive($data, $relations);
    }

    protected function getDataHandlerRelations(): array
    {
        $relations = [];

        foreach ($this->parameterBag as $parameter => $parameterValue) {
            if (!isset($GLOBALS['TCA'][$this->table]['columns'][$parameter])) {
                continue;
            }
            $fieldConfig = $GLOBALS['TCA'][$this->table]['columns'][$parameter]['config'];
            if ($fieldConfig['type'] === 'inline') {
                $foreignTable = $fieldConfig['foreign_table'];
                $foreignField = $fieldConfig['foreign_field'];
                $recordUids = [];
                foreach ($parameterValue as $record => $recordData) {
                    $recordId = $recordData['id'] ?? uniqid('NEW_RECORD');
                    $recordUids[] = $recordId;
                    unset($recordData['id']);
                    if (!strpos($this->parameterBag['pid'], '-') === 0) {
                        $recordData['pid'] = $this->parameterBag['pid'];
                    } else {
                        $recordData['pid'] = $this->parent->id;
                    }
                    $recordData[$foreignField] = $this->id;
                    $relations[$foreignTable][$recordId] = $recordData;
                }
                $this->parameterBag[$parameter] = implode(',', $recordUids);
            }
        }

        return $relations;
    }
}
