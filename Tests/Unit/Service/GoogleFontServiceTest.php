<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Unit\Service;

use BK2K\BootstrapPackage\Service\GoogleFontService;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Psr\Http\Message\ResponseInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class GoogleFontServiceTest extends UnitTestCase
{
    #[Test]
    #[DataProvider('supportsDataProvider')]
    public function supportsReturnsTrueOnlyForValidGoogleFontsUrls(string $url, bool $expected): void
    {
        $service = new GoogleFontService();
        $reflection = new \ReflectionMethod($service, 'supports');

        self::assertSame($expected, $reflection->invoke($service, $url));
    }

    public static function supportsDataProvider(): array
    {
        return [
            'valid Google Fonts URL' => [
                'https://fonts.googleapis.com/css?family=Roboto',
                true,
            ],
            'valid Google Fonts URL with css2' => [
                'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap',
                true,
            ],
            'invalid but common Google Fonts URL with white space and css2' => [
                'https://fonts.googleapis.com/css2?family=Open Sans:wght@400;700&display=swap',
                true,
            ],
            'valid Google Fonts URL with encoded white space and css2' => [
                'https://fonts.googleapis.com/css2?family=Open%20Sans:wght@400;700&display=swap',
                true,
            ],
            'HTTP URL rejected' => [
                'http://fonts.googleapis.com/css?family=Roboto',
                false,
            ],
            'wrong host rejected' => [
                'https://evil.com/css?family=Roboto',
                false,
            ],
            'subdomain attack rejected' => [
                'https://fonts.googleapis.com.evil.com/css?family=Roboto',
                false,
            ],
            'path injection rejected' => [
                'https://evil.com/fonts.googleapis.com/css?family=Roboto',
                false,
            ],
            'empty string rejected' => [
                '',
                false,
            ],
            'relative URL rejected' => [
                '/fonts.googleapis.com/css?family=Roboto',
                false,
            ],
            'protocol-relative URL rejected' => [
                '//fonts.googleapis.com/css?family=Roboto',
                false,
            ],
        ];
    }

    #[Test]
    #[DataProvider('isValidHttpsUrlDataProvider')]
    public function isValidHttpsUrlReturnsTrueOnlyForHttpsUrls(string $url, bool $expected): void
    {
        $service = new GoogleFontService();
        $reflection = new \ReflectionMethod($service, 'isValidHttpsUrl');

        self::assertSame($expected, $reflection->invoke($service, $url));
    }

    public static function isValidHttpsUrlDataProvider(): array
    {
        return [
            'valid HTTPS URL' => [
                'https://fonts.gstatic.com/s/roboto/v30/font.woff2',
                true,
            ],
            'HTTP URL rejected' => [
                'http://fonts.gstatic.com/s/roboto/v30/font.woff2',
                false,
            ],
            'empty string rejected' => [
                '',
                false,
            ],
            'relative URL rejected' => [
                '/path/to/font.woff2',
                false,
            ],
            'data URL rejected' => [
                'data:font/woff2;base64,abc123',
                false,
            ],
            'file URL rejected' => [
                'file:///etc/passwd',
                false,
            ],
            'javascript URL rejected' => [
                'javascript:alert(1)',
                false,
            ],
        ];
    }

    #[Test]
    #[DataProvider('isAllowedFontMimeTypeDataProvider')]
    public function isAllowedFontMimeTypeReturnsTrueOnlyForValidFontMimeTypes(string $contentType, bool $expected): void
    {
        $service = new GoogleFontService();
        $reflection = new \ReflectionMethod($service, 'isAllowedFontMimeType');

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getHeaderLine')->with('Content-Type')->willReturn($contentType);

        self::assertSame($expected, $reflection->invoke($service, $response));
    }

    public static function isAllowedFontMimeTypeDataProvider(): array
    {
        return [
            'font/woff allowed' => [
                'font/woff',
                true,
            ],
            'font/woff2 allowed' => [
                'font/woff2',
                true,
            ],
            'font/ttf allowed' => [
                'font/ttf',
                true,
            ],
            'font/otf allowed' => [
                'font/otf',
                true,
            ],
            'application/font-woff allowed' => [
                'application/font-woff',
                true,
            ],
            'application/font-woff2 allowed' => [
                'application/font-woff2',
                true,
            ],
            'application/x-font-woff allowed' => [
                'application/x-font-woff',
                true,
            ],
            'application/x-font-ttf allowed' => [
                'application/x-font-ttf',
                true,
            ],
            'application/vnd.ms-fontobject allowed' => [
                'application/vnd.ms-fontobject',
                true,
            ],
            'font/woff2 with charset allowed' => [
                'font/woff2; charset=utf-8',
                true,
            ],
            'font/woff2 uppercase normalized' => [
                'FONT/WOFF2',
                true,
            ],
            'text/html rejected' => [
                'text/html',
                false,
            ],
            'application/javascript rejected' => [
                'application/javascript',
                false,
            ],
            'text/css rejected' => [
                'text/css',
                false,
            ],
            'application/octet-stream rejected' => [
                'application/octet-stream',
                false,
            ],
            'empty content-type rejected' => [
                '',
                false,
            ],
            'image/svg+xml rejected' => [
                'image/svg+xml',
                false,
            ],
        ];
    }

    #[Test]
    public function getCachedFileReturnsNullForUnsupportedUrl(): void
    {
        $service = new GoogleFontService();

        self::assertNull($service->getCachedFile('https://evil.com/malicious.css'));
        self::assertNull($service->getCachedFile('http://fonts.googleapis.com/css?family=Roboto'));
        self::assertNull($service->getCachedFile(''));
    }

    #[Test]
    public function getCacheDirectoryContainsCacheDirectoryPrefix(): void
    {
        $this->resetSingletonInstances = true;
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey'] = 'test-encryption-key-for-unit-tests';

        $service = new GoogleFontService();
        $reflection = new \ReflectionMethod($service, 'getCacheDirectory');

        $result = $reflection->invoke($service, 'https://fonts.googleapis.com/css?family=Roboto');

        self::assertStringStartsWith('typo3temp/assets/bootstrappackage/fonts/', $result);
    }

    #[Test]
    public function getCacheIdentifierReturnsDifferentHashesForDifferentUrls(): void
    {
        $this->resetSingletonInstances = true;
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey'] = 'test-encryption-key-for-unit-tests';

        $service = new GoogleFontService();
        $reflection = new \ReflectionMethod($service, 'getCacheIdentifier');

        $hash1 = $reflection->invoke($service, 'https://fonts.googleapis.com/css?family=Roboto');
        $hash2 = $reflection->invoke($service, 'https://fonts.googleapis.com/css?family=OpenSans');

        self::assertNotSame($hash1, $hash2);
    }

    #[Test]
    public function getCacheIdentifierReturnsSameHashForSameUrl(): void
    {
        $this->resetSingletonInstances = true;
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey'] = 'test-encryption-key-for-unit-tests';

        $service = new GoogleFontService();
        $reflection = new \ReflectionMethod($service, 'getCacheIdentifier');

        $url = 'https://fonts.googleapis.com/css?family=Roboto';
        $hash1 = $reflection->invoke($service, $url);
        $hash2 = $reflection->invoke($service, $url);

        self::assertSame($hash1, $hash2);
    }

    #[Test]
    public function getCssFileCacheNameEndsWithWebfontCss(): void
    {
        $this->resetSingletonInstances = true;
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey'] = 'test-encryption-key-for-unit-tests';

        $service = new GoogleFontService();
        $reflection = new \ReflectionMethod($service, 'getCssFileCacheName');

        $result = $reflection->invoke($service, 'https://fonts.googleapis.com/css?family=Roboto');

        self::assertStringEndsWith('/webfont.css', $result);
    }
}
