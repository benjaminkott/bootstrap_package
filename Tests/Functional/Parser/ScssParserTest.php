<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\Parser;

use BK2K\BootstrapPackage\Service\CompileService;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\ExpectationFailedException;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\EventDispatcher\NoopEventDispatcher;
use TYPO3\CMS\Core\Http\ServerRequest;
use TYPO3\CMS\Core\TypoScript\AST\AstBuilder;
use TYPO3\CMS\Core\TypoScript\AST\Node\RootNode;
use TYPO3\CMS\Core\TypoScript\FrontendTypoScript;
use TYPO3\CMS\Core\TypoScript\Tokenizer\LossyTokenizer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Testcase for class \BK2K\BootstrapPackage\Parser\ScssParser
 */
class ScssParserTest extends FunctionalTestCase
{
    protected array $coreExtensionsToLoad = [
        'seo',
        'rte_ckeditor',
    ];

    protected array $testExtensionsToLoad = [
        'typo3conf/ext/bootstrap_package',
        'typo3conf/ext/demo_package',
    ];

    /**
     * Asserts that a file contains a needle.
     */
    protected static function assertFileContains(string $filename, string $needle): void
    {
        self::assertFileIsReadable($filename);
        $content = (string) file_get_contents($filename);

        try {
            self::assertStringContainsString($needle, $content);
        } catch (ExpectationFailedException $e) {
            self::fail(\sprintf(
                'Failed asserting that file \'%s\' contains \'%s\'',
                $filename,
                $needle
            ));
        }
    }

    #[DataProvider('scssParserCanCompileTestDataProvider')]
    #[Test]
    public function scssParserCanCompileTest(string $inputFile): void
    {
        $request = $this->buildRequest();
        $compileService = GeneralUtility::makeInstance(CompileService::class);
        $compiledFile = $compileService->getCompiledFile($request, $inputFile);

        self::assertFileExists(Environment::getPublicPath() . '/' . $compiledFile);
    }

    public static function scssParserCanCompileTestDataProvider(): array
    {
        return [
            'direct include' => [
                'inputFile' => 'typo3conf/ext/bootstrap_package/Resources/Public/Scss/bootstrap5/theme.scss',
            ],
            'relative include from symlinked package' => [
                'inputFile' => 'typo3conf/ext/demo_package/Resources/Public/Scss/Relative/theme.scss',
            ],
            'core syntax' => [
                'inputFile' => 'typo3conf/ext/demo_package/Resources/Public/Scss/CoreSyntax/theme.scss',
            ],
        ];
    }

    #[Test]
    public function urlsAreRelativeToTempTest(): void
    {
        $request = $this->buildRequest();
        $compileService = GeneralUtility::makeInstance(CompileService::class);
        $compiledFile = $compileService->getCompiledFile($request, 'typo3conf/ext/demo_package/Resources/Public/Scss/Path/theme.scss');

        self::assertFileContains(
            Environment::getPublicPath() . '/' . $compiledFile,
            'url("../../../../typo3conf/ext/demo_package/Resources/Public/Images/Contrib/BootstrapPackage.svg")'
        );
    }

    #[DataProvider('scssParserCanCompileTestDataProvider')]
    #[Test]
    public function sourceMapsAreIncluded(string $inputFile): void
    {
        $request = $this->buildRequest('plugin.tx_bootstrappackage.settings.cssSourceMapping = 1');
        $compileService = GeneralUtility::makeInstance(CompileService::class);
        $compiledFile = $compileService->getCompiledFile($request, $inputFile);
        $mapFile = $compiledFile . '.map';

        self::assertFileExists(Environment::getPublicPath() . '/' . $mapFile);
        self::assertFileContains(Environment::getPublicPath() . '/' . $compiledFile, '/*# sourceMappingURL=' . basename($mapFile));
    }

    protected function buildRequest(string $typoScriptString = ''): ServerRequest
    {
        $request = new ServerRequest();
        $lineStream = (new LossyTokenizer())->tokenize($typoScriptString);
        $typoScriptAst = (new AstBuilder(new NoopEventDispatcher()))->build($lineStream, new RootNode());
        /** @phpstan-ignore-next-line */
        $typoScriptAttribute = new FrontendTypoScript(new RootNode(), [], [], []);
        $typoScriptAttribute->setSetupTree($typoScriptAst);
        $typoScriptAttribute->setSetupArray($typoScriptAst->toArray());
        $request = $request->withAttribute('frontend.typoscript', $typoScriptAttribute);

        return $request;
    }
}
