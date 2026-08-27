<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\Service;

use BK2K\BootstrapPackage\Service\CompileService;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Configuration\SiteWriter;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\EventDispatcher\NoopEventDispatcher;
use TYPO3\CMS\Core\Http\ServerRequest;
use TYPO3\CMS\Core\Site\Entity\Site;
use TYPO3\CMS\Core\Site\SiteFinder;
use TYPO3\CMS\Core\TypoScript\AST\AstBuilder;
use TYPO3\CMS\Core\TypoScript\AST\Node\RootNode;
use TYPO3\CMS\Core\TypoScript\FrontendTypoScript;
use TYPO3\CMS\Core\TypoScript\Tokenizer\LossyTokenizer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Testcase for class \BK2K\BootstrapPackage\Service\CompileService
 */
final class CompileServiceTest extends FunctionalTestCase
{
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

    /**
     * Settings declared as boolean are cast to string on their way into TypoScript
     * constants, which leaves nothing but an empty string for a disabled setting.
     * The parser must not read that as an enabled setting.
     */
    #[DataProvider('booleanSettingsReachTheParserAsBooleansDataProvider')]
    #[Test]
    public function booleanSettingsReachTheParserAsBooleans(bool $enableGradients, string $expectedDeclaration): void
    {
        $site = $this->createSiteWithSettings([
            'plugin' => [
                'bootstrap_package' => [
                    'settings' => [
                        'scss' => [
                            'enable-gradients' => $enableGradients,
                        ],
                    ],
                ],
            ],
        ]);

        $compiledFile = GeneralUtility::makeInstance(CompileService::class)->getCompiledFile(
            $this->buildRequest($site),
            'typo3conf/ext/demo_package/Resources/Public/Scss/Variables/theme.scss'
        );

        self::assertNotNull($compiledFile);
        self::assertStringContainsString(
            $expectedDeclaration,
            (string) file_get_contents(Environment::getPublicPath() . '/' . $compiledFile)
        );
    }

    public static function booleanSettingsReachTheParserAsBooleansDataProvider(): array
    {
        return [
            'disabled setting' => [
                'enableGradients' => false,
                'expectedDeclaration' => 'gradients:disabled',
            ],
            'enabled setting' => [
                'enableGradients' => true,
                'expectedDeclaration' => 'gradients:enabled',
            ],
        ];
    }

    protected function createSiteWithSettings(array $settings): Site
    {
        $this->get(SiteWriter::class)->write('bootstrap-package-test', [
            'rootPageId' => 1,
            'base' => 'http://localhost/',
            'dependencies' => [
                'bootstrap-package/bootstrap-5',
            ],
            'settings' => $settings,
        ]);
        $this->get(CacheManager::class)->flushCaches();

        return $this->get(SiteFinder::class)->getSiteByIdentifier('bootstrap-package-test');
    }

    protected function buildRequest(Site $site): ServerRequest
    {
        // Site settings are written into TypoScript constants as plain strings,
        // see SysTemplateTreeBuilder::addDefaultTypoScriptConstantsFromSite().
        $flatSettings = [];
        foreach ($site->getSettings()->getAllFlat() as $identifier => $value) {
            $flatSettings[$identifier] = (string) $value;
        }

        $lineStream = (new LossyTokenizer())->tokenize('plugin.tx_bootstrappackage.settings.overrideParserVariables = 1');
        $typoScriptAst = (new AstBuilder(new NoopEventDispatcher()))->build($lineStream, new RootNode());

        $typoScriptAttribute = new FrontendTypoScript(new RootNode(), [], $flatSettings, []);
        $typoScriptAttribute->setSetupTree($typoScriptAst);
        $typoScriptAttribute->setSetupArray($typoScriptAst->toArray());

        return (new ServerRequest())
            ->withAttribute('site', $site)
            ->withAttribute('frontend.typoscript', $typoScriptAttribute);
    }
}
