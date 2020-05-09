<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\Parser;

use BK2K\BootstrapPackage\Service\CompileService;
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
     * @test
     * @dataProvider scssParserCanCompileTestDataProvider
     */
    public function scssParserCanCompileTest($inputFile)
    {
        sleep(5);
        $compileService = GeneralUtility::makeInstance(CompileService::class);
        $compiledFile = $compileService->getCompiledFile($inputFile);
        $this->assertFileExists($compiledFile);
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
            'absolute include from symlinked package containing a relative path' => [
                'inputFile' => 'typo3conf/ext/demo_package/Resources/Private/Scss/Relative/theme2.scss'
            ],
        ];
    }
}
