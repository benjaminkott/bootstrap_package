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
 * ArrayProcessor
 *
 * Basic Example:
 *
 * 10 = BK2K\BootstrapPackage\DataProcessing\ArrayProcessor
 * 10 {
 *   data {
 *     class = new super classes
 *     data-hello-some = data
 *     data-pagelayout = TEXT
 *     data-pagelayout {
 *       data = pagelayout
 *       replacement.10 {
 *         search = pagets__
 *         replace =
 *       }
 *       ifEmpty = default
 *     }
 *   }
 *   as = staticData
 * }
 */
class ArrayProcessor extends FilesProcessor
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
        $initialData = (array) ($processorConfiguration['data.'] ?? []);

        // Collect data
        $data = [];
        foreach ($initialData as $key => $value) {
            $key = substr($key, -1) === '.' ? substr_replace($key, '', -1) : $key;
            $value = (string) $cObj->stdWrapValue($key, $initialData);
            if ($value !== '') {
                $data[$key] = $value;
            }
        }

        // Set the target variable
        $targetVariableName = (string) $cObj->stdWrapValue('as', $processorConfiguration);
        if ($targetVariableName !== '') {
            $processedData[$targetVariableName] = $data;
        } else {
            $processedData['staticData'] = $data;
        }

        return $processedData;
    }
}
