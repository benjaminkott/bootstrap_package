<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\DataProcessing;

use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * ContainerContextProcessor
 */
class ContainerContextProcessor implements DataProcessorInterface
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
        if (!isset($processedData['data']['tx_container_parent'])
            || $processedData['data']['tx_container_parent'] === 0) {
            return $processedData;
        }

        $processedData['containerContext'] = $this->getContainerContext(
            $this->getPageRecords($cObj, $processedData['data']['pid']),
            $processedData['data']
        );
        $processedData['containerContext'] = array_reverse($processedData['containerContext']);

        return $processedData;
    }

    public function getContainerContext(array $pageRecords, array $data, int $level = 1): array
    {
        $containerContext = [];
        if (isset($data['tx_container_parent']) && isset($pageRecords[$data['tx_container_parent']])) {
            $parent = $pageRecords[$data['tx_container_parent']];
            $containerContext[] = $parent;
            $containerContext = array_merge(
                $containerContext,
                $this->getContainerContext($pageRecords, $parent, $level++)
            );
        }

        return $containerContext;
    }

    public function getPageRecords(ContentObjectRenderer $cObj, int $pid): array
    {
        $runtimeCache = GeneralUtility::makeInstance(CacheManager::class)->getCache('runtime');
        $cache = $runtimeCache->get('containerContext') ?? [];
        $cacheIdentifier = 'containerContext:' . $pid;

        if (!isset($cache[$cacheIdentifier])) {
            $records = $cObj->getRecords('tt_content', ['pidInList' => $pid]);
            $dataset = [];
            foreach ($records as $record) {
                $dataset[$record['uid']] = $record;
            }

            $cache[$cacheIdentifier] = $dataset;
            $runtimeCache->set('containerContext', $cache);
        }

        return $cache[$cacheIdentifier];
    }
}
