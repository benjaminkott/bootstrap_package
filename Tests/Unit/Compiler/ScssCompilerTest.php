<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Unit\Compiler;

use ScssPhp\ScssPhp\Compiler;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Testcase for class \ScssPhp\ScssPhp\Compiler
 */
class ScssCompilerTest extends UnitTestCase
{
    /**
     * @param string $file
     * @param string $expectedResultFile
     * @dataProvider compileDataProvider
     * @test
     */
    public function compile(string $file, string $expectedResultFile)
    {
        $scss = new Compiler();
        $resultCss = $scss->compile(file_get_contents(__DIR__ . '/' . $file), $file);
        $expectedCss = file_get_contents(__DIR__ . '/' . $expectedResultFile);
        $this->assertSame($expectedCss, $resultCss);
    }

    /**
     * @return array
     */
    public function compileDataProvider()
    {
        return [
            'Calculation' => [
                'Fixtures/Calculation/Input.scss',
                'Fixtures/Calculation/Output.css'
            ]
        ];
    }
}
