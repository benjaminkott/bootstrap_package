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
use Psr\EventDispatcher\EventDispatcherInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * IconService
 */
class IconService
{
    protected EventDispatcherInterface $eventDispatcher;

    public function __construct()
    {
        $this->eventDispatcher = GeneralUtility::makeInstance(EventDispatcherInterface::class);
    }

    public function getIconSetItems(array &$configuration): void
    {
        $iconSets = [];
        $iconSets[] = ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.none', ''];

        $iconProviders = $this->getIconProviders();
        foreach ($iconProviders as $iconProvider) {
            $iconSets[] = [
                $iconProvider->getName(),
                $iconProvider->getIdentifier(),
            ];
        }

        $configuration['items'] = $iconSets;
    }

    public function getIconItems(array &$configuration): void
    {
        $iconItems = [];
        $iconItems[] = [
            'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.none',
            0,
            'EXT:bootstrap_package/Resources/Public/Images/Icons/none.svg',
        ];

        $iconSetField = $configuration['config']['itemsProcConfig']['iconSetField'] ?? 'icon_set';
        $iconProviderIdentifier = $configuration['row'][$iconSetField][0] ?? '';
        $iconProvider = $this->getIconProviderForIdentifier($iconProviderIdentifier);
        if ($iconProvider !== null) {
            $icons = $iconProvider->getIconList()->getIcons();
            foreach ($icons as $icon) {
                $iconItems[] = [
                    $icon->getName(),
                    $icon->getIdentifier(),
                    $icon->getPreviewImage(),
                ];
            }
        }

        $configuration['items'] = $iconItems;
    }

    public function getIconProviderForIdentifier(string $identifier): ?IconProviderInterface
    {
        $iconProviders = $this->getIconProviders();
        foreach ($iconProviders as $iconProvider) {
            if ($iconProvider->supports($identifier)) {
                return $iconProvider;
            }
        }
        return null;
    }

    public function getIconProviders(): array
    {
        $iconProviders = [];

        if (isset($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/bootstrap-package/icons']['provider'])
            && is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/bootstrap-package/icons']['provider'])
        ) {
            foreach ($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/bootstrap-package/icons']['provider'] as $className) {
                /** @var class-string<IconProviderInterface> $className */
                /** @var IconProviderInterface $iconProvider */
                $iconProvider = GeneralUtility::makeInstance($className);
                $iconProviders[] = $iconProvider;
            }
        }

        /** @var ModifyIconProvidersEvent $event */
        $event = $this->eventDispatcher->dispatch(new ModifyIconProvidersEvent($iconProviders));

        return $event->getIconProviders();
    }
}
