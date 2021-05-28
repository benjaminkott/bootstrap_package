<?php declare(strict_types=1);

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
    public function compile(string $file, string $expectedResultFile): void
    {
        $scss = new Compiler();
        $resultCss = $scss->compileString((string) file_get_contents(__DIR__ . '/' . $file), $file)->getCss();
        $expectedCss = file_get_contents(__DIR__ . '/' . $expectedResultFile);
        self::assertSame($expectedCss, $resultCss);
    }

    /**
     * @return array
     */
    public function compileDataProvider(): array
    {
        return [
            'Calculation' => [
                'Fixtures/Calculation/Input.scss',
                'Fixtures/Calculation/Output.css'
            ]
        ];
    }
}
