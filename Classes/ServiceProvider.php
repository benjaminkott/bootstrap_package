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

        $optionalDependencies = [];
        if (isset($availableSets['typo3/form'])) {
            $optionalDependencies[] = 'bootstrap-package/ext-form';
        }
        if (isset($availableSets['typo3/seo-sitemap'])) {
            $optionalDependencies[] = 'bootstrap-package/ext-seo';
        }
        if (isset($availableSets['typo3/indexed-search'])) {
            $optionalDependencies[] = 'bootstrap-package/ext-indexed-search';
        }
        // TODO: Introspect `$availableSets` once EXT:container provides a set
        if ($container->get(PackageManager::class)->isPackageActive('container')) {
            $optionalDependencies[] = 'bootstrap-package/ext-container';
        }

        $setCollector->add(
            new SetDefinition(...[
                ...$bpFullSet->toArray(),
                'dependencies' => [
                    ...$bpFullSet->dependencies,
                    ...$optionalDependencies,
                ],
            ])
        );
        return $setCollector;
    }
}
