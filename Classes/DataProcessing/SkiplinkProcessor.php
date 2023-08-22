<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\DataProcessing;

use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\DataProcessing\FilesProcessor;

/**
 * SkiplinkProcessor
 *
 * Basic Example:
 *
 * 10 = BK2K\BootstrapPackage\DataProcessing\SkiplinkProcessor
 * 10 {
 *   entries {
 *     mainnavigation {
 *       label = LLL:EXT:bootstrap_package/Resources/Private/Language/locallang.xlf:skiptomainnavigation
 *       section = mainnavigation
 *       priority = 20
 *     }
 *     content {
 *       label = LLL:EXT:bootstrap_package/Resources/Private/Language/locallang.xlf:skiptocontent
 *       section = page-content
 *       priority = 10
 *     }
 *     footer {
 *       label = LLL:EXT:bootstrap_package/Resources/Private/Language/locallang.xlf:skiptofooter
 *       section = page-footer
 *       priority = 0
 *     }
 *   }
 *   as = skiplinks
 * }
 */
class SkiplinkProcessor extends FilesProcessor
{
    /**
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData)
    {
        $entries = (array) ($processorConfiguration['entries.'] ?? []);

        // Collect data
        $data = [];
        foreach ($entries as $key => $entry) {
            if (substr($key, -1) !== '.') {
                continue;
            }
            $entryData = [
                'label' => isset($entry['label']) && is_string($entry['label']) && $entry['label'] !== '' ? $entry['label'] : null,
                'section' => isset($entry['section']) && is_string($entry['section']) && $entry['section'] !== '' ? $entry['section'] : null,
                'priority' => isset($entry['priority']) && (is_string($entry['priority']) || is_numeric($entry['priority'])) ? (int) $entry['priority'] : 0,
            ];

            if ($entry['label'] === null || $entry['section'] === null) {
                continue;
            }
            $data[] = $entryData;
        }
        usort($data, function (array $a, array $b) {
            return $b['priority'] <=> $a['priority'];
        });

        // Set the target variable
        $targetVariableName = (string) $cObj->stdWrapValue('as', $processorConfiguration);
        if ($targetVariableName !== '') {
            $processedData[$targetVariableName] = $data;
        } else {
            $processedData['skiplinks'] = $data;
        }

        return $processedData;
    }
}
