<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\SiteCreator\Service;

use BK2K\BootstrapPackage\SiteCreator\Dto\Site;
use BK2K\BootstrapPackage\SiteCreator\Factory\SiteFactory;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Configuration\Loader\YamlFileLoader;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * SiteCreatorService
 */
class SiteCreatorService
{
    public function createSiteSetup(): void
    {
        $filename = GeneralUtility::getFileAbsFileName('EXT:bootstrap_package/Classes/SiteCreator/Resources/Sites/Demo/siteconfiguration.yaml');
        $loader = GeneralUtility::makeInstance(YamlFileLoader::class);
        $configuration = $loader->load($filename, 0);
        $site = SiteFactory::fromArray($configuration['sitecreator']);
        $this->createSite($site);
    }

    public function createSite(Site $site): void
    {
        $data = $site->toDataHandler();
        $data = $this->sortByPriority($data);

        /** @var DataHandler $dataHandler */
        $dataHandler = GeneralUtility::makeInstance(DataHandler::class);
        $dataHandler->start($data, []);
        $dataHandler->process_datamap();

        BackendUtility::setUpdateSignal('updatePageTree');
    }

    /**
     * @return array<string, mixed>
     */
    protected function sortByPriority(array $data): array
    {
        $priorities = [
            'pages' => 10,
            'tt_content' => 9,
            'sys_template' => 1,
        ];
        uksort($data, function ($a, $b) use ($priorities) {
            $priorityA = $priorities[$a] ?? 5;
            $priorityB = $priorities[$b] ?? 5;
            if ($priorityA === $priorityB) {
                return 0;
            } elseif ($priorityA > $priorityB) {
                return -1;
            } else {
                return 1;
            }
        });

        return $data;
    }
}
