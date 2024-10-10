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
     * @param string $title
     * @param string $expectedResult
     * @dataProvider getEmbedCodeDataProvider
     * @test
     */
    public function getEmbedCode(?string $url, ?string $class, ?string $title, $expectedResult): void
    {
        self::assertSame($expectedResult, (new ExternalMediaUtility())->getEmbedCode($url, $class, $title));
    }

    /**
     * @return array
     */
    public static function getEmbedCodeDataProvider(): array
    {
        return [
            // empty
            'empty null' => [
                null,
                null,
                null,
                null,
            ],
            'empty string' => [
                '',
                '',
                '',
                null,
            ],
            // url variants
            'www.youtube.com' => [
                'https://www.youtube.com/watch?v=zpOVYePk6mM',
                null,
                null,
                '<iframe src="https://www.youtube-nocookie.com/embed/zpOVYePk6mM" frameborder="0" allowfullscreen></iframe>',
            ],
            'youtube.com' => [
                'https://youtube.com/watch?v=zpOVYePk6mM',
                null,
                null,
                '<iframe src="https://www.youtube-nocookie.com/embed/zpOVYePk6mM" frameborder="0" allowfullscreen></iframe>',
            ],
            'www.youtu.be' => [
                'https://www.youtu.be/zpOVYePk6mM',
                null,
                null,
                '<iframe src="https://www.youtube-nocookie.com/embed/zpOVYePk6mM" frameborder="0" allowfullscreen></iframe>',
            ],
            'youtu.de' => [
                'https://youtu.be/zpOVYePk6mM',
                null,
                null,
                '<iframe src="https://www.youtube-nocookie.com/embed/zpOVYePk6mM" frameborder="0" allowfullscreen></iframe>',
            ],
            'vimeo' => [
                'https://vimeo.com/143018597',
                null,
                null,
                '<iframe src="https://player.vimeo.com/video/143018597" frameborder="0" allowfullscreen></iframe>',
            ],
            // class
            'with class' => [
                'https://www.youtube.com/watch?v=zpOVYePk6mM',
                'demo',
                null,
                '<iframe src="https://www.youtube-nocookie.com/embed/zpOVYePk6mM" frameborder="0" class="demo" allowfullscreen></iframe>',
            ],
            'with class empty' => [
                'https://www.youtube.com/watch?v=zpOVYePk6mM',
                ' ',
                null,
                '<iframe src="https://www.youtube-nocookie.com/embed/zpOVYePk6mM" frameborder="0" allowfullscreen></iframe>',
            ],
            // title
            'with title' => [
                'https://www.youtube.com/watch?v=zpOVYePk6mM',
                null,
                'demo',
                '<iframe src="https://www.youtube-nocookie.com/embed/zpOVYePk6mM" frameborder="0" title="demo" allowfullscreen></iframe>',
            ],
            'with title empty' => [
                'https://www.youtube.com/watch?v=zpOVYePk6mM',
                null,
                ' ',
                '<iframe src="https://www.youtube-nocookie.com/embed/zpOVYePk6mM" frameborder="0" allowfullscreen></iframe>',
            ],
        ];
    }
}
