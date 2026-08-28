<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\Parser;

use BK2K\BootstrapPackage\Service\CompileService;
use PHPUnit\Framework\Attributes\Test;
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
 * Cache files are addressed relative to the public path, so every check on them
 * has to be resolved against that path rather than against the working
 * directory. A CLI request runs from the project root, one level above.
 */
final class CacheWorkingDirectoryTest extends FunctionalTestCase
{
    private const INPUT_FILE = 'typo3conf/ext/demo_package/Resources/Public/Scss/Relative/theme.scss';
    private const MARKER = '/* served from cache */';

    protected array $coreExtensionsToLoad = [
        'seo',
        'rte_ckeditor',
        'extensionmanager',
        'install',
    ];

    protected array $testExtensionsToLoad = [
        'typo3conf/ext/bootstrap_package',
        'typo3conf/ext/demo_package',
    ];

    #[Test]
    public function cachedCssIsReusedWithinThePublicPath(): void
    {
        $cacheFile = $this->compile();
        $this->markCacheFile($cacheFile);

        $this->compile();

        self::assertTrue(
            $this->cacheFileIsUntouched($cacheFile),
            'Css was recompiled although the cache file is up to date'
        );
    }

    #[Test]
    public function cachedCssIsReusedOutsideThePublicPath(): void
    {
        $cacheFile = $this->compile();
        $this->markCacheFile($cacheFile);

        $this->fromProjectRoot(fn () => $this->compile());

        self::assertTrue(
            $this->cacheFileIsUntouched($cacheFile),
            'Css was recompiled because the cache file was looked up in the working directory'
        );
    }

    #[Test]
    public function outdatedCssIsRebuiltOutsideThePublicPath(): void
    {
        $cacheFile = $this->compile();
        $this->markCacheFile($cacheFile);
        // Older than every source the metadata lists, which is what makes the
        // cache outdated
        touch($cacheFile, 1);

        $this->fromProjectRoot(fn () => $this->compile());

        self::assertFalse(
            $this->cacheFileIsUntouched($cacheFile),
            'Outdated css was kept because its timestamp was read in the working directory'
        );
    }

    /**
     * @return string Absolute path of the compiled css file
     */
    private function compile(): string
    {
        $compiledFile = GeneralUtility::makeInstance(CompileService::class)
            ->getCompiledFile($this->buildRequest(), self::INPUT_FILE);
        self::assertIsString($compiledFile);

        return Environment::getPublicPath() . '/' . $compiledFile;
    }

    /**
     * Replaces the compiled css with a marker, so that a rebuild is told from a
     * reused cache by the content of the file instead of by its timestamp.
     */
    private function markCacheFile(string $cacheFile): void
    {
        GeneralUtility::writeFile($cacheFile, self::MARKER, true);
        clearstatcache(true, $cacheFile);
    }

    private function cacheFileIsUntouched(string $cacheFile): bool
    {
        return file_get_contents($cacheFile) === self::MARKER;
    }

    private function fromProjectRoot(callable $callback): void
    {
        $workingDirectory = (string) getcwd();
        chdir(dirname(Environment::getPublicPath()));

        try {
            $callback();
        } finally {
            chdir($workingDirectory);
            clearstatcache();
        }
    }

    private function buildRequest(): ServerRequest
    {
        $request = new ServerRequest();
        $lineStream = (new LossyTokenizer())->tokenize('');
        $typoScriptAst = (new AstBuilder(new NoopEventDispatcher()))->build($lineStream, new RootNode());

        $typoScriptAttribute = new FrontendTypoScript(new RootNode(), [], [], []);
        $typoScriptAttribute->setSetupTree($typoScriptAst);
        $typoScriptAttribute->setSetupArray($typoScriptAst->toArray());

        return $request->withAttribute('frontend.typoscript', $typoScriptAttribute);
    }
}
