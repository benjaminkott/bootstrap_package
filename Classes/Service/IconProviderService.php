<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Service;

use BK2K\BootstrapPackage\Events\ModifyIconProvidersEvent;
use BK2K\BootstrapPackage\Icons\GlyphiconsProvider;
use BK2K\BootstrapPackage\Icons\IconProviderInterface;
use BK2K\BootstrapPackage\Icons\IoniconsProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;

final class IconProviderService
{
    private array $iconProvidersToAdd = [
        GlyphiconsProvider::class,
        IoniconsProvider::class,
    ];

    public function __invoke(ModifyIconProvidersEvent $event): void
    {
        $iconProviders = $event->getIconProviders();
        /** @var class-string<IconProviderInterface> $iconProvider */
        foreach ($this->iconProvidersToAdd as $iconProvider) {
            $iconProviders[] = GeneralUtility::makeInstance($iconProvider);
        }

        $event->setIconProviders($iconProviders);
    }
}
