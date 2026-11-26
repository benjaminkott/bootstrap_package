<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional;

use TYPO3\CMS\Core\Resource\ResourceStorage;
use TYPO3\CMS\Core\Resource\StorageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Adds fileadmin/ of the test instance as default file storage
 */
trait FixtureStorageTrait
{
    private function createFixtureStorage(): ResourceStorage
    {
        GeneralUtility::mkdir_deep($this->instancePath . '/fileadmin/');
        $storageRepository = $this->get(StorageRepository::class);
        self::assertInstanceOf(StorageRepository::class, $storageRepository);
        // TYPO3 v14 lacks addLocalStorage(), TYPO3 v15 deprecates createLocalStorage()
        $uid = method_exists($storageRepository, 'addLocalStorage') // @phpstan-ignore function.alreadyNarrowedType
            ? $storageRepository->addLocalStorage('fixture', 'fileadmin/', true)
            : $storageRepository->createLocalStorage('fixture', 'fileadmin/', 'relative', '', true); // @phpstan-ignore method.deprecated
        $storage = $storageRepository->findByUid($uid);
        self::assertInstanceOf(ResourceStorage::class, $storage);

        return $storage;
    }
}
