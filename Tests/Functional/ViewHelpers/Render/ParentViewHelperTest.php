<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\AgencyPack\Blog\Tests\Functional\ViewHelpers;

use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextFactory;
use TYPO3\CMS\Fluid\View\TemplateView;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;
use TYPO3Fluid\Fluid\View\Exception\InvalidTemplateResourceException;

final class ParentViewHelperTest extends FunctionalTestCase
{
    protected array $testExtensionsToLoad = [
        'typo3conf/ext/bootstrap_package',
        'typo3conf/ext/demo_package'
    ];

    /**
     * @test
     */
    public function renderExistAll(): void
    {
        $context = $this->get(RenderingContextFactory::class)->create([
            'partialRootPaths' => [
                'EXT:demo_package/Resources/Private/ParentViewHelperTest/Partials/ExistAll/Level1/',
                'EXT:demo_package/Resources/Private/ParentViewHelperTest/Partials/ExistAll/Level2/',
                'EXT:demo_package/Resources/Private/ParentViewHelperTest/Partials/ExistAll/Level3/',
                'EXT:demo_package/Resources/Private/ParentViewHelperTest/Partials/ExistAll/Level4/',
            ]
        ]);

        $context->getTemplatePaths()->setTemplateSource('<f:render partial="Partial" />');
        $view = (new TemplateView($context));

        self::assertSame(
            implode(
                PHP_EOL,
                [
                    '',
                    'BASIC - LEVEL1',
                    '',
                    'BASIC - LEVEL2',
                    '',
                    'BASIC - LEVEL3',
                    '',
                    'BASIC - LEVEL4',
                    '',
                ]
            ),
            $view->render()
        );
    }

    /**
     * @test
     */
    public function renderFirstAndLast(): void
    {
        $context = $this->get(RenderingContextFactory::class)->create([
            'partialRootPaths' => [
                'EXT:demo_package/Resources/Private/ParentViewHelperTest/Partials/FirstAndLast/Level1/',
                'EXT:demo_package/Resources/Private/ParentViewHelperTest/Partials/FirstAndLast/Level2/',
                'EXT:demo_package/Resources/Private/ParentViewHelperTest/Partials/FirstAndLast/Level3/',
                'EXT:demo_package/Resources/Private/ParentViewHelperTest/Partials/FirstAndLast/Level4/',
            ]
        ]);

        $context->getTemplatePaths()->setTemplateSource('<f:render partial="Partial" />');
        $view = (new TemplateView($context));

        self::assertSame(
            implode(
                PHP_EOL,
                [
                    '',
                    'BASIC - LEVEL1',
                    '',
                    'BASIC - LEVEL4',
                    '',
                ]
            ),
            $view->render()
        );
    }

    /**
     * @test
     */
    public function renderNoParent(): void
    {
        $context = $this->get(RenderingContextFactory::class)->create([
            'partialRootPaths' => [
                'EXT:demo_package/Resources/Private/ParentViewHelperTest/Partials/NoParent/Level1/',
                'EXT:demo_package/Resources/Private/ParentViewHelperTest/Partials/NoParent/Level2/',
                'EXT:demo_package/Resources/Private/ParentViewHelperTest/Partials/NoParent/Level3/',
                'EXT:demo_package/Resources/Private/ParentViewHelperTest/Partials/NoParent/Level4/',
            ]
        ]);

        $context->getTemplatePaths()->setTemplateSource('<f:render partial="Partial" />');
        $view = (new TemplateView($context));

        self::assertSame(
            implode(
                PHP_EOL,
                [
                    '',
                    'BASIC - LEVEL4',
                    '',
                ]
            ),
            $view->render()
        );
    }

    /**
     * @test
     */
    public function renderOnlyOnePartialPath(): void
    {
        $context = $this->get(RenderingContextFactory::class)->create([
            'partialRootPaths' => [
                'EXT:demo_package/Resources/Private/ParentViewHelperTest/Partials/OnlyOnePartialPath/Level1/',
            ]
        ]);
        $context->getTemplatePaths()->setTemplateSource('<f:render partial="Partial" />');
        $view = (new TemplateView($context));

        self::assertSame(
            implode(
                PHP_EOL,
                [
                    '',
                    'BASIC - LEVEL1',
                    '',
                ]
            ),
            $view->render()
        );
    }

    /**
     * @test
     */
    public function renderNoneExist(): void
    {
        $context = $this->get(RenderingContextFactory::class)->create([
            'partialRootPaths' => [
                'EXT:demo_package/Resources/Private/ParentViewHelperTest/Partials/NoneExist/Level1/',
                'EXT:demo_package/Resources/Private/ParentViewHelperTest/Partials/NoneExist/Level2/',
                'EXT:demo_package/Resources/Private/ParentViewHelperTest/Partials/NoneExist/Level3/',
                'EXT:demo_package/Resources/Private/ParentViewHelperTest/Partials/NoneExist/Level4/',
            ]
        ]);

        $context->getTemplatePaths()->setTemplateSource('<f:render partial="Partial" />');
        $view = (new TemplateView($context));

        $this->expectException(InvalidTemplateResourceException::class);
        $view->render();
    }
}
