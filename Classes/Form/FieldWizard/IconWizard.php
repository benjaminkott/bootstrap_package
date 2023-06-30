<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Form\FieldWizard;

use BK2K\BootstrapPackage\Service\IconService;
use TYPO3\CMS\Backend\Form\AbstractNode;
use TYPO3\CMS\Backend\Form\Utility\FormEngineUtility;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class IconWizard extends AbstractNode
{
    public function render(): array
    {
        $selectIcons = [];
        $result = $this->initializeResultArray();
        $parameterArray = $this->data['parameterArray'];

        $iconSetField = $parameterArray['fieldConf']['config']['itemsProcConfig']['iconSetField'] ?? 'icon_set';
        $iconProviderIdentifier = $this->data['databaseRow'][$iconSetField][0] ?? '';
        $iconProvider = GeneralUtility::makeInstance(IconService::class)->getIconProviderForIdentifier($iconProviderIdentifier);
        $iconList = $iconProvider !== null ? $iconProvider->getIconList() : null;

        $selectItems = $parameterArray['fieldConf']['config']['items'];
        $selectItemCounter = 0;
        foreach ($selectItems as $item) {
            if ((new Typo3Version())->getMajorVersion() < 12) {
                $item = [
                    'label' => $item[0] ?? '',
                    'value' => $item[1] ?? '',
                    'icon' => $item[2] ?? '',
                ];
            }

            if ($item['value'] === '--div--') {
                continue;
            }

            $icon = null;
            if ($iconList !== null) {
                $iconSetIcon = $iconList->getIcon((string) $item['value']);
                if ($iconSetIcon !== null) {
                    $iconSetIcon->setHeight(32);
                    $iconSetIcon->setWidth(32);
                    $icon = $iconSetIcon->render();
                }
            }

            if ($icon === null) {
                $icon = isset($item['icon']) && trim($item['icon']) !== '' ? FormEngineUtility::getIconHtml($item['icon'], $item['label'], $item['label']) : '';
            }

            if ($icon !== '') {
                $fieldValue = $this->data['databaseRow'][$this->data['fieldName']];
                $selectIcons[] = [
                    'title' => $item['label'],
                    'active' => ($fieldValue[0] ?? false) === (string)($item['value'] ?? ''),
                    'icon' => $icon,
                    'index' => $selectItemCounter,
                ];
            }
            $selectItemCounter++;
        }

        $html = [];
        if (count($selectIcons) > 0) {
            if ((new Typo3Version())->getMajorVersion() < 12) {
                $html[] = '<div class="t3js-forms-select-single-icons icon-list">';
                $html[] =    '<div class="row">';
                foreach ($selectIcons as $selectIcon) {
                    $active = $selectIcon['active'] ? ' active' : '';
                    $html[] =   '<div class="col col-auto item' . $active . '">';
                    $html[] = '<a href="#" title="' . htmlspecialchars($selectIcon['title'], ENT_COMPAT, 'UTF-8', false) . '" data-select-index="' . htmlspecialchars((string)$selectIcon['index']) . '">';
                    $html[] =   $selectIcon['icon'];
                    $html[] = '</a>';
                    $html[] =   '</div>';
                }
                $html[] =    '</div>';
                $html[] = '</div>';
            } else {
                $html[] = '<div class="t3js-forms-select-single-icons form-wizard-icon-list">';
                foreach ($selectIcons as $selectIcon) {
                    $active = $selectIcon['active'] ? ' active' : '';
                    $html[] = '<div class="form-wizard-icon-list-item">';
                    $html[] =   '<a class="' . $active . '" href="#" title="' . htmlspecialchars($selectIcon['title'], ENT_COMPAT, 'UTF-8', false) . '" data-select-index="' . htmlspecialchars((string)$selectIcon['index']) . '">';
                    $html[] =       $selectIcon['icon'];
                    $html[] =   '</a>';
                    $html[] = '</div>';
                }
                $html[] = '</div>';
            }
        }

        $result['html'] = implode(LF, $html);
        return $result;
    }
}
