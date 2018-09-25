<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\DataProcessing;

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Resource\ProcessedFile;
use TYPO3\CMS\Core\Utility\CsvUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\DataProcessing\FilesProcessor;

/**
 * CsvFileProcessor
 */
class CsvFileProcessor extends FilesProcessor
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
        // Set the maximum amount of columns
        $maximumColumns = $cObj->stdWrapValue('maximumColumns', $processorConfiguration, 0);

        // Set the field delimiter which is "," by default
        $fieldDelimiter = $cObj->stdWrapValue('fieldDelimiter', $processorConfiguration, ',');

        // Set the field enclosure which is " by default
        $fieldEnclosure = $cObj->stdWrapValue('fieldEnclosure', $processorConfiguration, '"');

        // Get processed files
        $processedData = parent::process($cObj, $contentObjectConfiguration, $processorConfiguration, $processedData);
        $targetVariableName = $cObj->stdWrapValue('as', $processorConfiguration, 'files');
        $files = $processedData[$targetVariableName];
        unset($processedData[$targetVariableName]);

        foreach ($files as $key => $value) {
            if (is_object($value) && in_array(get_class($value), [FileReference::class, File::class], true)) {
                /** @var ProcessedFile $value */
                if ($value->getExtension() !== 'csv') {
                    unset($files[$key]);
                } else {
                    $originalFile = $value->getOriginalFile();
                    $content = $originalFile->getContents();
                    $files[$key] = [
                        'file' => $value,
                        'bodytext' => $content,
                        'table' => CsvUtility::csvToArray(
                            $content,
                            $fieldDelimiter,
                            $fieldEnclosure,
                            (int)$maximumColumns
                        )
                    ];
                }
            }
        }
        $files = array_values(array_filter($files));
        $processedData[$targetVariableName] = $files;

        return $processedData;
    }
}
