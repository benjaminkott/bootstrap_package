<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Unit\DataProcessing;

use BK2K\BootstrapPackage\DataProcessing\SkiplinkProcessor;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\DependencyInjection\Container;
use TYPO3\CMS\Frontend\ContentObject\ContentDataProcessor;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\DataProcessing\DataProcessorRegistry;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class SkiplinkProcessorTest extends UnitTestCase
{
    protected ContentDataProcessor $contentDataProcessor;
    protected Container $container;
    protected MockObject&DataProcessorRegistry $dataProcessorRegistryMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->container = new Container();
        $this->dataProcessorRegistryMock = $this->getMockBuilder(DataProcessorRegistry::class)->disableOriginalConstructor()->getMock();
        $this->dataProcessorRegistryMock->method('getDataProcessor')->willReturn(null);
        $this->contentDataProcessor = new ContentDataProcessor(
            $this->container,
            $this->dataProcessorRegistryMock
        );
    }

    /**
     * @dataProvider getProcessDataProvider
     * @test
     */
    public function process(array $setup, array $expectation): void
    {
        $contentObjectRendererStub = new ContentObjectRenderer();
        $config = [
            'dataProcessing.' => [
                '10' => SkiplinkProcessor::class,
                '10.' => $setup,
            ],
        ];

        $variables = [];
        self::assertSame(
            $expectation,
            $this->contentDataProcessor->process($contentObjectRendererStub, $config, $variables)
        );
    }

    public static function getProcessDataProvider(): array
    {
        return [
            'basic' => [
                [
                    'entries.' => [
                        'mainnavigation.' => [
                            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/locallang.xlf:skiptomainnavigation',
                            'section' => 'mainnavigation',
                            'priority' => '100',
                        ],
                        'content.' => [
                            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/locallang.xlf:skiptomaincontent',
                            'section' => 'page-content',
                            'priority' => '300',
                        ],
                        'footer.' => [
                            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/locallang.xlf:skiptopagefooter',
                            'section' => 'page-footer',
                            'priority' => '200',
                        ],
                    ],
                    'as' => 'test',
                ],
                [
                    'test' => [
                        0 => [
                            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/locallang.xlf:skiptomaincontent',
                            'section' => 'page-content',
                            'priority' => 300,
                        ],
                        1 => [
                            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/locallang.xlf:skiptopagefooter',
                            'section' => 'page-footer',
                            'priority' => 200,
                        ],
                        2 => [
                            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/locallang.xlf:skiptomainnavigation',
                            'section' => 'mainnavigation',
                            'priority' => 100,
                        ],
                    ]
                ]
            ]
        ];
    }
}
