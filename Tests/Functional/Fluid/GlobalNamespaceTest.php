<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\Fluid;

use BK2K\BootstrapPackage\ViewHelpers\ImplodeViewHelper;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Fluid\Core\ViewHelper\ViewHelperResolverFactoryInterface;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Testcase for the global "bk2k" Fluid namespace
 *
 * @see Configuration/Fluid/Namespaces.php
 */
final class GlobalNamespaceTest extends FunctionalTestCase
{
    protected array $coreExtensionsToLoad = [
        'seo',
        'rte_ckeditor',
        'extensionmanager',
        'install',
    ];

    protected array $testExtensionsToLoad = [
        'typo3conf/ext/bootstrap_package',
    ];

    #[Test]
    public function bk2kNamespaceIsAvailableWithoutBeingDeclaredInATemplate(): void
    {
        $resolver = $this->get(ViewHelperResolverFactoryInterface::class)->create();

        self::assertSame(
            ImplodeViewHelper::class,
            $resolver->resolveViewHelperClassName('bk2k', 'implode')
        );
    }

    #[Test]
    public function namespaceIsNotRegisteredThroughGlobalsOnSupportingVersions(): void
    {
        if ((new Typo3Version())->getMajorVersion() < 14) {
            self::markTestSkipped('TYPO3 v13.4 has no Configuration/Fluid/Namespaces.php and still needs TYPO3_CONF_VARS');
        }

        self::assertArrayNotHasKey(
            'bk2k',
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces'] ?? []
        );
    }
}
