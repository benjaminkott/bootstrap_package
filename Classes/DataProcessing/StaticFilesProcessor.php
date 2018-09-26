<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\DataProcessing;

use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * This processor generates a set of file objects.
 *
 * 10 = BK2K\BootstrapPackage\DataProcessing\StaticFilesProcessor
 * 10 {
 *   files {
 *     0.field = image
 *     1 = EXT:bootstrap_package/Resources/Public/Images/Icons/icon-1.png
 *     circle = EXT:bootstrap_package/Resources/Public/Images/Icons/icon-circle.png
 *   }
 *   as = staticFiles
 * }
 */
class StaticFilesProcessor implements DataProcessorInterface
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
        if (isset($processorConfiguration['if.']) && !$cObj->checkIf($processorConfiguration['if.'])) {
            return $processedData;
        }

        // Collect possible files
        $files = [];
        if (!empty($processorConfiguration['files.'])) {
            $filesConfiguration = $processorConfiguration['files.'];
            foreach ($filesConfiguration as $key => $file) {
                $key = substr($key, -1) === '.' ? substr_replace($key, '', -1) : $key;
                $value = $cObj->stdWrapValue($key, $filesConfiguration);
                if (!empty($value)) {
                    $files[$key] = $value;
                }
            }
        }

        // Get file objects
        $images = [];
        if (!empty($files)) {
            $resourceFactory = GeneralUtility::makeInstance(ResourceFactory::class);
            foreach ($files as $key => $file) {
                $absFilename = GeneralUtility::getFileAbsFileName($file);
                if (file_exists($absFilename)) {
                    $images[$key] = $resourceFactory->retrieveFileOrFolderObject($absFilename);
                }
            }
        }

        // Set the target variable
        $targetVariableName = $cObj->stdWrapValue('as', $processorConfiguration);
        if (!empty($targetVariableName)) {
            $processedData[$targetVariableName] = $images;
        } else {
            $processedData['staticFiles'] = $images;
        }

        return $processedData;
    }
}
