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
use BK2K\BootstrapPackage\Icons\IconProviderInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

final readonly class IconProviderService
{
    public function __construct(
        #[AutowireIterator('bootstrapPackage.iconProvider')]
        private iterable $iconProviders
    ) {
    }

    public function __invoke(ModifyIconProvidersEvent $event): void
    {
        $iconProviders = $event->getIconProviders();
        /** @var IconProviderInterface[] $iconProvider */
        foreach ($this->iconProviders as $iconProvider) {
            $iconProviders[] = $iconProvider;
        }

        $event->setIconProviders($iconProviders);
    }
}
