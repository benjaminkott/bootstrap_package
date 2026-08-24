<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Unit;

use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * From TYPO3 v15 the package metadata is read from composer.json only, so
 * "extra.typo3/cms.version" has to stay in step with the version in
 * ext_emconf.php. The release tooling writes the latter but not the former,
 * which is what this test guards.
 */
class PackageManifestTest extends UnitTestCase
{
    public function testComposerManifestVersionMatchesExtEmConfVersion(): void
    {
        $root = dirname(__DIR__, 2);

        $composerManifest = json_decode((string)file_get_contents($root . '/composer.json'), true, 512, JSON_THROW_ON_ERROR);
        $composerVersion = $composerManifest['extra']['typo3/cms']['version'] ?? null;

        self::assertNotNull($composerVersion, 'composer.json must declare extra.typo3/cms.version');
        self::assertSame($this->readExtEmConfVersion($root . '/ext_emconf.php'), $composerVersion);
    }

    public function testComposerManifestDeclaresProvidedPackages(): void
    {
        $root = dirname(__DIR__, 2);

        $composerManifest = json_decode((string)file_get_contents($root . '/composer.json'), true, 512, JSON_THROW_ON_ERROR);
        $providesPackages = $composerManifest['extra']['typo3/cms']['Package']['providesPackages'] ?? null;

        self::assertIsArray($providesPackages, 'composer.json must declare extra.typo3/cms.Package.providesPackages');

        foreach ($providesPackages as $packageName => $relativePath) {
            self::assertArrayHasKey(
                $packageName,
                $composerManifest['require'],
                sprintf('Provided package "%s" is not required in composer.json', $packageName)
            );
            self::assertDirectoryExists($root . '/' . $relativePath);
        }
    }

    /**
     * ext_emconf.php declares its data by assigning $EM_CONF[$_EXTKEY], the way
     * the package manager reads it, so it has to be executed rather than parsed.
     */
    private function readExtEmConfVersion(string $file): mixed
    {
        $definedVariables = (static function (string $file, string $extensionKey): array {
            $_EXTKEY = $extensionKey;
            require $file;

            return get_defined_vars();
        })($file, 'bootstrap_package');

        return $definedVariables['EM_CONF']['bootstrap_package']['version'] ?? null;
    }
}
