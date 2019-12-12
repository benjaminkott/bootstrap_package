<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\DataProcessing;

use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\Page\PageRepository;

/**
 * Data Processor: Menu Processor
 * Correctly define menu states for all possible types
 */
class MenuProcessor extends \TYPO3\CMS\Frontend\DataProcessing\MenuProcessor
{
    /**
     * @param ContentObjectRenderer $cObj
     * @param array $contentObjectConfiguration
     * @param array $processorConfiguration
     * @param array $processedData
     * @return array
     */
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ): array {
        $processedData = parent::process($cObj, $contentObjectConfiguration, $processorConfiguration, $processedData);

        if (!empty($this->menuTargetVariableName) && isset($processedData[$this->menuTargetVariableName])) {
            $processedData[$this->menuTargetVariableName] = $this->adjustActiveItems(
                $processedData[$this->menuTargetVariableName]
            );
        }
        return $processedData;
    }

    /**
     * Loop through all generated items and find redirect items that are actually active
     *
     * @param array $items
     * @return array
     */
    protected function adjustActiveItems(array $items): array
    {
        $active = [];
        foreach ((array)$GLOBALS['TSFE']->rootLine as $item) {
            $active[] = (int)$item['uid'];
        }
        $current = (int)$GLOBALS['TSFE']->id;
        if ($current > 0) {
            $items = $this->loopItemsForActivePage($items, $current, $active);
        }
        return $items;
    }

    /**
     * @param array $items
     * @param int $current
     * @param array $active
     * @return array
     */
    protected function loopItemsForActivePage(array $items, int $current, array $active = []): array
    {
        foreach ($items as &$item) {
            if ($item['data']['doktype'] === PageRepository::DOKTYPE_SHORTCUT) {
                switch ($item['data']['shortcut_mode']) {
                    case PageRepository::SHORTCUT_MODE_NONE:
                        // Typecasted to int to match original input
                        $item['current'] = (int)($item['current'] ? 1 : $current === (int)$item['data']['shortcut']);
                        $item['active'] = (int)($item['current'] || $item['active'] ? 1 : in_array((int)$item['data']['shortcut'], $active, true));
                        break;

                    case PageRepository::SHORTCUT_MODE_PARENT_PAGE:
                        // Typecasted to int to match original input
                        $item['current'] = (int)($item['current'] ? 1 : $current === (int)$item['data']['pid']);
                        // On parent page only show active when specific page is configured or already rendered as active
                        $item['active'] = ($item['active'] ? 1 : $item['current']);
                        break;

                    case PageRepository::SHORTCUT_MODE_FIRST_SUBPAGE:
                    case PageRepository::SHORTCUT_MODE_RANDOM_SUBPAGE:
                    default:
                        // Not able to implement..
                        // This should be already correct via parent::process (HMENU)
                        break;
                }
            }

            // Nullable targets should target href in current frame
            $item['target'] = $item['target'] ?? $item['data']['target'] ?: '_self';

            // Now loop through children if any available
            if (isset($item['children']) && !empty($item['children'])) {
                $item['children'] = $this->loopItemsForActivePage($item['children'], $current, $active);
            }
        }

        return $items;
    }
}
