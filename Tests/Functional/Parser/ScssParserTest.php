<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\Parser;

use BK2K\BootstrapPackage\Service\CompileService;
use PHPUnit\Framework\ExpectationFailedException;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Testcase for class \BK2K\BootstrapPackage\Parser\ScssParser
 */
class ScssParserTest extends FunctionalTestCase
{
    /**
     * @var array
     */
    protected $testExtensionsToLoad = [
        'typo3conf/ext/bootstrap_package',
        'typo3conf/ext/demo_package',
    ];

    /**
     * Asserts that a file contains a needle.
     */
    protected static function assertFileContains(string $filename, string $needle): void
    {
        self::assertFileIsReadable($filename);
        $content = file_get_contents($filename);

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

    /**
     * @test
     * @dataProvider scssParserCanCompileTestDataProvider
     */
    public function scssParserCanCompileTest($inputFile)
    {
        $compileService = GeneralUtility::makeInstance(CompileService::class);
        $compiledFile = $compileService->getCompiledFile($inputFile);
        $this->assertFileExists(Environment::getPublicPath() . '/' . $compiledFile);
    }

    /**
     * @return array
     */
    public function scssParserCanCompileTestDataProvider()
    {
        return [
            'direct include' => [
                'inputFile' => 'typo3conf/ext/bootstrap_package/Resources/Public/Scss/Theme/theme.scss'
            ],
            'relative include from symlinked package' => [
                'inputFile' => 'typo3conf/ext/demo_package/Resources/Private/Scss/Relative/theme.scss'
            ],
            'core syntax' => [
                'inputFile' => 'typo3conf/ext/demo_package/Resources/Private/Scss/CoreSyntax/theme.scss'
            ],
            'legacy include' => [
                'inputFile' => 'typo3conf/ext/demo_package/Resources/Private/Scss/Legacy/theme.scss'
            ],
        ];
    }

    /**
     * @test
     */
    public function urlsAreRelativeToTempTest()
    {
        $compileService = GeneralUtility::makeInstance(CompileService::class);
        $compiledFile = Environment::getPublicPath() . '/' . $compileService->getCompiledFile(
            'typo3conf/ext/bootstrap_package/Resources/Public/Scss/Theme/theme.scss'
        );
        $this->assertFileContains(
            $compiledFile,
            'url("../../../../typo3conf/ext/bootstrap_package/Resources/Public/Images/PhotoSwipe/default-skin.png")'
        );
        $this->assertFileContains(
            $compiledFile,
            'url("../../../../typo3conf/ext/bootstrap_package/Resources/Public/Images/PhotoSwipe/default-skin.svg")'
        );
        $this->assertFileContains(
            $compiledFile,
            'url("../../../../typo3conf/ext/bootstrap_package/Resources/Public/Images/PhotoSwipe/preloader.gif")'
        );
    }

    /**
     * @test
     */
    public function sitepackageImagesAreUsedTest()
    {
        $compileService = GeneralUtility::makeInstance(CompileService::class);
        $compiledFile = Environment::getPublicPath() . '/' . $compileService->getCompiledFile(
            'typo3conf/ext/demo_package/Resources/Private/Scss/Relative/theme.scss'
        );
        $this->assertFileContains(
            $compiledFile,
            'url("../../../../typo3conf/ext/demo_package/Resources/Public/Images/PhotoSwipe/default-skin.png")'
        );
        $this->assertFileContains(
            $compiledFile,
            'url("../../../../typo3conf/ext/demo_package/Resources/Public/Images/PhotoSwipe/default-skin.svg")'
        );
        $this->assertFileContains(
            $compiledFile,
            'url("../../../../typo3conf/ext/demo_package/Resources/Public/Images/PhotoSwipe/preloader.gif")'
        );
    }
}
