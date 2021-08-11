<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\DataProcessing;

use BK2K\BootstrapPackage\Icons\FileIcon;
use BK2K\BootstrapPackage\Service\IconService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
use TYPO3\CMS\Frontend\DataProcessing\FilesProcessor;

/**
 * Minimal TypoScript configuration
 *
 * 10 = BK2K\BootstrapPackage\DataProcessing\IconsDataProcessor
 * 10 {
 *   iconSetFieldName = icon_set
 *   iconIdentifierFieldName = icon
 *   iconFileFieldName = icon_file
 *   as = icon
 * }
 */
class IconsDataProcessor implements DataProcessorInterface
{
    /**
     * @var IconService
     */
    protected $iconService;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->iconService = GeneralUtility::makeInstance(IconService::class);
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
        $icon = null;
        $config = [
            'iconSet' => (string) $cObj->stdWrapValue('iconSet', $processorConfiguration, ''),
            'iconIdentifier' => (string) $cObj->stdWrapValue('iconIdentifier', $processorConfiguration, ''),
            'iconFileFieldName' => (string) $cObj->stdWrapValue('iconFileFieldName', $processorConfiguration, ''),
        ];

        if ($config['iconSet'] !== '' && $config['iconIdentifier'] !== '') {
            $iconProvider = $this->iconService->getIconProviderForIdentifier($config['iconSet']);
            if ($iconProvider !== null) {
                $icon = $iconProvider->getIconList()->getIcon($config['iconIdentifier']);
            }
        } elseif ($config['iconFileFieldName'] !== '') {
            $filesProcessor = GeneralUtility::makeInstance(FilesProcessor::class);
            $filesData = $filesProcessor->process(
                $cObj,
                $contentObjectConfiguration,
                ['references.' => ['fieldName' => $config['iconFileFieldName']]],
                ['data' => $processedData['data']]
            );
            if (isset($filesData['files'][0])) {
                $file = $filesData['files'][0];
                $icon = (new FileIcon())
                    ->setFile($file)
                    ->setIdentifier($file->getIdentifier())
                    ->setName($file->getName())
                    ->setPreviewImage($file->getPublicUrl())
                ;
            }
        }

        $targetVariableName = (string) $cObj->stdWrapValue('as', $processorConfiguration, 'icon');
        $processedData[$targetVariableName] = $icon;

        return $processedData;
    }
}
