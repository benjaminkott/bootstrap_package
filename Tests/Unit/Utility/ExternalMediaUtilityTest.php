<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Unit\Utility;

use BK2K\BootstrapPackage\Utility\ExternalMediaUtility;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Testcase for class \BK2K\BootstrapPackage\Utility\ExternalMediaUtility
 */
class ExternalMediaUtilityTest extends UnitTestCase
{
    /**
     * @param string $url
     * @param string $class
     * @param string $expectedResult
     * @dataProvider getEmbedCodeDataProvider
     * @test
     */
    public function getEmbedCode(string $url, string $class, $expectedResult): void
    {
        self::assertSame($expectedResult, (new ExternalMediaUtility())->getEmbedCode($url, $class));
    }

    /**
     * @return array
     */
    public function getEmbedCodeDataProvider(): array
    {
        return [
            'empty' => ['', '', null],
            'www.youtube.com' => ['https://www.youtube.com/watch?v=zpOVYePk6mM', '', '<iframe src="https://www.youtube-nocookie.com/embed/zpOVYePk6mM" frameborder="0" allowfullscreen></iframe>'],
            'youtube.com' => ['https://youtube.com/watch?v=zpOVYePk6mM', '', '<iframe src="https://www.youtube-nocookie.com/embed/zpOVYePk6mM" frameborder="0" allowfullscreen></iframe>'],
            'www.youtu.be' => ['https://www.youtu.be/zpOVYePk6mM', '', '<iframe src="https://www.youtube-nocookie.com/embed/zpOVYePk6mM" frameborder="0" allowfullscreen></iframe>'],
            'youtu.de' => ['https://youtu.be/zpOVYePk6mM', '', '<iframe src="https://www.youtube-nocookie.com/embed/zpOVYePk6mM" frameborder="0" allowfullscreen></iframe>'],
            'vimeo' => ['https://vimeo.com/143018597', '', '<iframe src="https://player.vimeo.com/video/143018597" frameborder="0" allowfullscreen></iframe>'],
            'www.youtube.com with class' => ['https://www.youtube.com/watch?v=zpOVYePk6mM', 'test', '<iframe class="test" src="https://www.youtube-nocookie.com/embed/zpOVYePk6mM" frameborder="0" allowfullscreen></iframe>'],
            'youtube.com with class' => ['https://youtube.com/watch?v=zpOVYePk6mM', 'test', '<iframe class="test" src="https://www.youtube-nocookie.com/embed/zpOVYePk6mM" frameborder="0" allowfullscreen></iframe>'],
            'www.youtu.be with class' => ['https://www.youtu.be/zpOVYePk6mM', 'test', '<iframe class="test" src="https://www.youtube-nocookie.com/embed/zpOVYePk6mM" frameborder="0" allowfullscreen></iframe>'],
            'youtu.de with class' => ['https://youtu.be/zpOVYePk6mM', 'test', '<iframe class="test" src="https://www.youtube-nocookie.com/embed/zpOVYePk6mM" frameborder="0" allowfullscreen></iframe>'],
            'vimeo with class' => ['https://vimeo.com/143018597', 'test', '<iframe class="test" src="https://player.vimeo.com/video/143018597" frameborder="0" allowfullscreen></iframe>'],
        ];
    }
}
