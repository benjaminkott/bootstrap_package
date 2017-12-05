<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\DataProcessing;

use TYPO3\CMS\Backend\View\BackendLayoutView;
use TYPO3\CMS\Core\TypoScript\TypoScriptService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * PageProcessor
 */
class PageProcessor implements DataProcessorInterface
{
    const CONTENTELEMENTSPLIT = '###CONTENTELEMENTSPLIT1512475849###';

    /**
     * @var ContentObjectRenderer
     */
    public $cObj;

    /**
     * @var array
     */
    protected $processorConfiguration;

    /**
     * @var array
     */
    public $defaultConfiguration = [
        'as' => 'content',
        'additionalSectionClass' => 'section',
        'additionalContainerClass' => 'container',
        'additionalRowClass' => 'row',
        'additionalColumnClass' => 'column'
    ];

    /**
     * @param string $key
     * @return string
     */
    protected function getConfigurationValue($key)
    {
        return $this->cObj->stdWrapValue($key, $this->processorConfiguration, $this->defaultConfiguration[$key]);
    }

    /**
     * @return TypoScriptService
     */
    protected function getTypoScriptService(): TypoScriptService
    {
        return GeneralUtility::makeInstance(TypoScriptService::class);
    }

    /**
     * @return BackendLayoutView
     */
    protected function getBackendLayoutView(): BackendLayoutView
    {
        return GeneralUtility::makeInstance(BackendLayoutView::class);
    }

    /**
     * @return TypoScriptFrontendController
     */
    protected function getTypoScriptFrontendController(): TypoScriptFrontendController
    {
        return $GLOBALS['TSFE'];
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        // OUTPUT NOT USED PREVENT BACKENDLAYOUTVIEW FROM
        // CRASHING IN FRONTEND, $GLOBALS['LANG'] NOT AVAILABLE
        // CAN HAVE POSSIBLE SIDEEFFECTS, NO IDEA
        //
        // @TODO FIX BackendLayoutView
        if (empty($GLOBALS['LANG'])) {
            $GLOBALS['LANG'] = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Localization\LanguageService::class);
        }
    }

    /**
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData)
    {
        // Init
        $this->cObj = $cObj;
        $this->processorConfiguration = $processorConfiguration;

        $backendLayout = $this->getBackendLayoutView()->getSelectedBackendLayout($processedData['data']['uid']);
        $typoscriptService = $this->getTypoScriptService();
        $backendLayoutRows = $typoscriptService->convertTypoScriptArrayToPlainArray($backendLayout['__config']['backend_layout.']['rows.']);
        $backendLayoutData = [];

        foreach ($backendLayoutRows as $rowKey => $row) {
            $row['wrap'] = ($row['wrap'] === 'false' || $row['wrap'] === '0' ? false : true);
            $row['sectionClass'] = $this->getClassString([$this->getConfigurationValue('additionalSectionClass'), $row['sectionClass']]);
            $row['containerClass'] = $this->getClassString([$this->getConfigurationValue('additionalContainerClass'), $row['containerClass']]);
            $row['class'] = $this->getClassString([$this->getConfigurationValue('additionalRowClass'), $row['class']]);
            foreach ($row['columns'] as $columnKey => $column) {
                $column['name'] = trim($this->getTypoScriptFrontendController()->sL($column['name']));
                $column['class'] = $this->getClassString([$this->getConfigurationValue('additionalColumnClass'), $column['class']]);
                $column['slide'] = (bool) $column['slide'];
                $column['wrap'] = $row['wrap'];
                $column['contentElements'] = [];
                if ($column['colPos'] || $column['colPos'] == '0') {
                    $column['contentElements'] = $this->getColumnData(
                        $processedData['data']['uid'],                          // PageUid
                        $column['colPos'],                                      // ColPos
                        $processedData['data']['content_from_pid'],             // Show Content From Uid
                        $column['slide']                                        // Slide
                    );
                }
                $row['columns'][$columnKey] = $column;
            }
            $backendLayoutData[] = $row;
        }

        $data = [
            'identifier' => $this->getBackendLayoutView()->getSelectedCombinedIdentifier($processedData['data']['uid']),
            'rows' => $backendLayoutData
        ];

        // Return processed data
        $processedData[$this->getConfigurationValue('as')] = $data;
        return $processedData;
    }

    /**
     * @param array $classArray
     * @return string
     */
    public function getClassString($classArray)
    {
        $processedClassArray = [];
        foreach ($classArray as $class) {
            if (trim($class)) {
                $processedClassArray[] = $class;
            }
        }
        return implode(' ', $processedClassArray);
    }

    /**
     * @param int $pageUid
     * @param int $columnPosition
     * @param int $contentFromPid
     * @param bool $slide
     *
     * @return array
     */
    public function getColumnData($pageUid, $columnPosition, $contentFromPid, $slide = false)
    {
        // Get rendered content
        $contentString = $this->cObj->getContentObject('CONTENT')->render([
            'table' => 'tt_content',
            'select.' => [
                'includeRecordsWithoutDefaultTranslation' => 1,
                'orderBy' => 'sorting',
                'where' => 'colPos=' . (int) $columnPosition,
                'pidInList' => (int) $pageUid,
                'pidInList.' => [
                    'override' => $contentFromPid
                ]
            ],
            'slide' => ($slide ? -1 : 0),
            'renderObj.' => [
                'stdWrap.' => [
                    'wrap' => '|' . self::CONTENTELEMENTSPLIT,
                    'required' => 1
                ]
            ]
        ]);

        // Split rendered content and remove empty item
        $contentArray = array_slice(
            GeneralUtility::trimExplode(
                self::CONTENTELEMENTSPLIT,
                $contentString
            ),
            0,
            -1
        );

        // Rearrange content elements
        $contentArrayProcessed = [];
        foreach ($contentArray as $contentElementString) {
            $contentArrayProcessed[] = [
                'data' => [], // @todo Unprocessed data should be here
                'markup' => $contentElementString
            ];
        }

        return $contentArrayProcessed;
    }
}
