<?php

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace BK2K\BootstrapPackage\DataProcessing;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
use TYPO3\CMS\Frontend\Resource\FileCollector;

/**
 * This data processor can be used for processing data for record which contain
 * relations to sys_file records (e.g. sys_file_reference records) or for fetching
 * files directly from UIDs or from folders or collections.
 *
 *
 * Example TypoScript configuration:
 *
 * 10 = BK2K\BootstrapPackage\DataProcessing\PaginationProcessor
 * 10 {
 *   references.fieldName = image
 *   collections = 13,15
 *   as = myfiles
 * }
 *
 * whereas "myfiles" can further be used as a variable {myfiles} inside a Fluid template for iteration.
 */
class PaginateProcessor implements DataProcessorInterface
{
    protected const PAGINATION = 'pagination';

    protected array $configuration = [
        'itemsPerPage' => 10,
        'insertAbove' => false,
        'insertBelow' => true,
        'maximumNumberOfLinks' => 99,
        'addQueryStringMethod' => '',
        'section' => ''
    ];

    /**
     * Process data of a record to resolve File objects to the view
     *
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

        // gather the variable name to process, default "files"
        $variableName = $cObj->stdWrapValue('variableName', $processorConfiguration, 'files');
        if (!isset($processedData[$variableName]) || empty($processedData[$variableName])) {
            return $processedData;
        }


        return $processedData;

        $this->currentPage = (int)$cObj->getRequest()->getQueryParams()['page'] ?? 1;

        $cObj->getRequest()->getAttribute('page', 1);

        $cObj->data['items_per_page'];
        $processedData["data"]["items_per_page"];


        $this->initializeConfiguration($contentObjectConfiguration, $processorConfiguration);

        $this->objects = $this->widgetConfiguration['objects'];
        ArrayUtility::mergeRecursiveWithOverrule($this->configuration, $this->widgetConfiguration['configuration'], false);
        $itemsPerPage = (int)$this->configuration['itemsPerPage']; //items_per_page
        $this->numberOfPages = $itemsPerPage > 0 ? ceil(count($this->objects) / $itemsPerPage) : 0;
     
        $this->maximumNumberOfLinks = (int)$this->configuration['maximumNumberOfLinks'];


        // set current page
        $this->currentPage = (int)$currentPage;
        if ($this->currentPage < 1) {
            $this->currentPage = 1;
        }
        if ($this->currentPage > $this->numberOfPages) {
            // set $modifiedObjects to NULL if the page does not exist
            $modifiedObjects = null;
        } else {
            // modify query
            $itemsPerPage = (int)$this->configuration['itemsPerPage'];
            $offset = 0;
            if ($this->objects instanceof QueryResultInterface) {
                $offset = (int)$this->objects->getQuery()->getOffset();
            }
            if ($this->currentPage > 1) {
                $offset = $offset + ((int)($itemsPerPage * ($this->currentPage - 1)));
            }
            $modifiedObjects = $this->prepareObjectsSlice($itemsPerPage, $offset);
        }
        $this->view->assign('contentArguments', [
            $this->widgetConfiguration['as'] => $modifiedObjects
        ]);
        $this->view->assign('configuration', $this->configuration);
        $this->view->assign('pagination', $this->buildPagination());        


        // gather data
        /** @var FileCollector $fileCollector */
        $fileCollector = GeneralUtility::makeInstance(FileCollector::class);

        // references / relations
        if (
            (isset($processorConfiguration['references']) && $processorConfiguration['references'])
            || (isset($processorConfiguration['references.']) && $processorConfiguration['references.'])
        ) {
            $referencesUidList = (string)$cObj->stdWrapValue('references', $processorConfiguration ?? []);
            $referencesUids = GeneralUtility::intExplode(',', $referencesUidList, true);
            $fileCollector->addFileReferences($referencesUids);

            if (!empty($processorConfiguration['references.'])) {
                $referenceConfiguration = $processorConfiguration['references.'];
                $relationField = $cObj->stdWrapValue('fieldName', $referenceConfiguration ?? []);

                // If no reference fieldName is set, there's nothing to do
                if (!empty($relationField)) {
                    // Fetch the references of the default element
                    $relationTable = $cObj->stdWrapValue('table', $referenceConfiguration, $cObj->getCurrentTable());
                    if (!empty($relationTable)) {
                        $fileCollector->addFilesFromRelation($relationTable, $relationField, $cObj->data);
                    }
                }
            }
        }

        // files
        $files = $cObj->stdWrapValue('files', $processorConfiguration ?? []);
        if ($files) {
            $files = GeneralUtility::intExplode(',', (string)$files, true);
            $fileCollector->addFiles($files);
        }

        // collections
        $collections = $cObj->stdWrapValue('collections', $processorConfiguration ?? []);
        if (!empty($collections)) {
            $collections = GeneralUtility::trimExplode(',', (string)$collections, true);
            $fileCollector->addFilesFromFileCollections($collections);
        }

        // folders
        $folders = $cObj->stdWrapValue('folders', $processorConfiguration ?? []);
        if (!empty($folders)) {
            $folders = GeneralUtility::trimExplode(',', (string)$folders, true);
            $fileCollector->addFilesFromFolders($folders, !empty($processorConfiguration['folders.']['recursive']));
        }

        // make sure to sort the files
        $sortingProperty = $cObj->stdWrapValue('sorting', $processorConfiguration ?? []);
        if ($sortingProperty) {
            $sortingDirection = $cObj->stdWrapValue(
                'direction',
                $processorConfiguration['sorting.'] ?? [],
                'ascending'
            );

            $fileCollector->sort($sortingProperty, $sortingDirection);
        }

        // set the files into a variable, default "files"
        $processedData[self::PAGINATION][$variableName] = $this->buildPagination();

        return $processedData;
    }

    /**
     * Returns an array with the keys "pages", "current", "numberOfPages",
     * "nextPage" & "previousPage"
     *
     * @return array
     */
    protected function buildPagination()
    {
        $this->calculateDisplayRange();
        $pages = [];
        for ($i = $this->displayRangeStart; $i <= $this->displayRangeEnd; $i++) {
            $pages[] = ['number' => $i, 'isCurrent' => $i === $this->currentPage];
        }
        $pagination = [
            'pages' => $pages,
            'current' => $this->currentPage,
            'numberOfPages' => $this->numberOfPages,
            'displayRangeStart' => $this->displayRangeStart,
            'displayRangeEnd' => $this->displayRangeEnd,
            'hasLessPages' => $this->displayRangeStart > 2,
            'hasMorePages' => $this->displayRangeEnd + 1 < $this->numberOfPages
        ];
        if ($this->currentPage < $this->numberOfPages) {
            $pagination['nextPage'] = $this->currentPage + 1;
        }
        if ($this->currentPage > 1) {
            $pagination['previousPage'] = $this->currentPage - 1;
        }
        return $pagination;
    }
}
