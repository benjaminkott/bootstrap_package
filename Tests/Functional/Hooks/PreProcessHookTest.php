<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\Hooks;

use BK2K\BootstrapPackage\Hooks\PageRenderer\PreProcessHook;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Core\SystemEnvironmentBuilder;
use TYPO3\CMS\Core\EventDispatcher\NoopEventDispatcher;
use TYPO3\CMS\Core\Http\ServerRequest;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\TypoScript\AST\AstBuilder;
use TYPO3\CMS\Core\TypoScript\AST\Node\RootNode;
use TYPO3\CMS\Core\TypoScript\FrontendTypoScript;
use TYPO3\CMS\Core\TypoScript\Tokenizer\LossyTokenizer;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Testcase for class \BK2K\BootstrapPackage\Hooks\PageRenderer\PreProcessHook
 */
final class PreProcessHookTest extends FunctionalTestCase
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

    private const THEME = 'typo3conf/ext/bootstrap_package/Resources/Public/Scss/bootstrap5/theme.scss';

    protected function tearDown(): void
    {
        unset($GLOBALS['TYPO3_REQUEST']);
        parent::tearDown();
    }

    /**
     * TYPO3 v13 compresses and concatenates the CSS after the hook, which
     * moves it away from the source map.
     */
    #[Test]
    public function compiledFileWithSourceMapIsLeftAsCompiled(): void
    {
        $params = $this->process('plugin.tx_bootstrappackage.settings.cssSourceMapping = 1');

        $settings = reset($params['cssFiles']);
        self::assertFalse($settings['compress']);
        self::assertTrue($settings['excludeFromConcatenation']);
    }

    #[Test]
    public function compiledFileWithoutSourceMapKeepsItsSettings(): void
    {
        $params = $this->process('plugin.tx_bootstrappackage.settings.cssSourceMapping = 0');

        $settings = reset($params['cssFiles']);
        self::assertTrue($settings['compress']);
        self::assertFalse($settings['excludeFromConcatenation']);
    }

    private function process(string $typoScriptString): array
    {
        $lineStream = (new LossyTokenizer())->tokenize($typoScriptString);
        $typoScriptAst = (new AstBuilder(new NoopEventDispatcher()))->build($lineStream, new RootNode());
        $typoScript = new FrontendTypoScript(new RootNode(), [], [], []);
        $typoScript->setSetupTree($typoScriptAst);
        $typoScript->setSetupArray($typoScriptAst->toArray());
        $GLOBALS['TYPO3_REQUEST'] = (new ServerRequest())
            ->withAttribute('applicationType', SystemEnvironmentBuilder::REQUESTTYPE_FE)
            ->withAttribute('frontend.typoscript', $typoScript);

        $params = [
            'cssLibs' => [],
            'cssFiles' => [
                self::THEME => ['file' => self::THEME, 'compress' => true, 'excludeFromConcatenation' => false],
            ],
        ];
        $pageRenderer = $this->get(PageRenderer::class);
        (new PreProcessHook())->execute($params, $pageRenderer);

        self::assertCount(1, $params['cssFiles']);
        self::assertArrayNotHasKey(self::THEME, $params['cssFiles']);

        return $params;
    }
}
