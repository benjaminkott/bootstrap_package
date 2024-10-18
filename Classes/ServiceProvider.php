<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage;

use Psr\Container\ContainerInterface;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Package\AbstractServiceProvider;
use TYPO3\CMS\Core\Package\PackageManager;
use TYPO3\CMS\Core\Site\Set\SetCollector;
use TYPO3\CMS\Core\Site\Set\SetDefinition;

/**
 * @internal
 */
class ServiceProvider extends AbstractServiceProvider
{
    protected static function getPackagePath(): string
    {
        return __DIR__ . '/../';
    }

    protected static function getPackageName(): string
    {
        return 'bk2k/bootstrap-package';
    }

    public function getFactories(): array
    {
        return [];
    }

    public function getExtensions(): array
    {
        if ((new Typo3Version)->getMajorVersion() <= 12) {
            return parent::getExtensions();
        }

        return [
            SetCollector::class => [ static::class, 'configureSetCollector' ],
        ] + parent::getExtensions();
    }

    public static function configureSetCollector(ContainerInterface $container, SetCollector $setCollector, ?string $path = null): SetCollector
    {
        $setCollector = parent::configureSetCollector($container, $setCollector, $path);
        $availableSets = $setCollector->getSetDefinitions();
        $bpFullSet = $availableSets['bootstrap-package/full'] ?? null;
        if ($bpFullSet === null) {
            return $setCollector;
        }

        $removeFromFullSet = [];
        foreach ($availableSets as $set) {
            if (!str_starts_with($set->name, 'bootstrap-package/')) {
                continue;
            }

            // temporary workaround
            $dependenciesToDrop = [];
            foreach ($set->optionalDependencies as $optional) {
                if (!isset($availableSets[$optional])) {
                    $removeFromFullSet[$set->name] = true;
                    $dependenciesToDrop[] = $optional;
                }
            }
            // temporary workaround for core bug https://forge.typo3.org/issues/105346
            // PHP Warning: Undefined array key "typo3/form" in …/core/Classes/Service/DependencyOrderingService.php line 209
            if ($dependenciesToDrop !== []) {
                $setCollector->add(
                    new SetDefinition(...[
                        ...$set->toArray(),
                        'optionalDependencies' => array_diff($set->optionalDependencies, $dependenciesToDrop),
                    ])
                );
            }
        }

        // TODO: Introspect `$availableSets` once EXT:container provides a set
        if (!$container->get(PackageManager::class)->isPackageActive('container')) {
            $removeFromFullSet['bootstrap-package/ext-container'] = true;
        }

        $setCollector->add(
            new SetDefinition(...[
                ...$bpFullSet->toArray(),
                'dependencies' => array_filter(
                    $bpFullSet->dependencies,
                    static fn ($dependency) => !isset($removeFromFullSet[$dependency])
                ),
            ])
        );
        return $setCollector;
    }
}
