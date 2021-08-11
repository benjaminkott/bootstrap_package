<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Unit\Utility;

use BK2K\BootstrapPackage\Utility\ImageVariantsUtility;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Testcase for class \BK2K\BootstrapPackage\Utility\ImageVariantsUtility
 */
class ImageVariantsUtilityTest extends UnitTestCase
{
    /**
     * @param array $data
     * @param array $expectedResult
     * @dataProvider getImageVariantsTestDataProvider
     * @test
     */
    public function getImageVariantsTest(array $data, array $expectedResult): void
    {
        $variants = isset($data['variants']) ? $data['variants'] : null;
        $multiplier = isset($data['multiplier']) ? $data['multiplier'] : null;
        $corrections = isset($data['corrections']) ? $data['corrections'] : null;
        $gutters = isset($data['gutters']) ? $data['gutters'] : null;
        $result = ImageVariantsUtility::getImageVariants($variants, $multiplier, $gutters, $corrections);
        self::assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public function getImageVariantsTestDataProvider(): array
    {
        return [
            'empty' => [
                [],
                [
                    'default' => [
                        'breakpoint' => 1400,
                        'width' => 1280,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1
                            ]
                        ]
                    ],
                    'xlarge' => [
                        'breakpoint' => 1200,
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1
                            ]
                        ]
                    ],
                    'large' => [
                        'breakpoint' => 992,
                        'width' => 920,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ],
                    'medium' => [
                        'breakpoint' => 768,
                        'width' => 680,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ],
                    'small' => [
                        'breakpoint' => 576,
                        'width' => 500,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ],
                    'extrasmall' => [
                        'width' => 374,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ]
                ]
            ],
            'variants' => [
                [
                    'variants' => [
                        'default' => [
                            'breakpoint' => 1200,
                            'width' => 1100
                        ]
                    ]
                ],
                [
                    'default' => [
                        'breakpoint' => 1200,
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1
                            ]
                        ]
                    ]
                ]
            ],
            'variants invalid' => [
                [
                    'variants' => [
                        'empty' => [],
                        'missing-width' => [
                            'breakpoint' => 1200
                        ],
                        'unsupported-properties' => [
                            'foo' => 10,
                            'bar' => 20
                        ],
                        'null' => null,
                        'string' => 'foo',
                        'int' => 1337
                    ]
                ],
                []
            ],
            'variants invalid properties' => [
                [
                    'variants' => [
                        'numeric-string' => [
                            'width' => '100'
                        ],
                        'string' => [
                            'width' => 'foo'
                        ],
                        'px' => [
                            'width' => '0.5px'
                        ],
                        'percent' => [
                            'width' => '50%',
                        ],
                        'null' => [
                            'width' => null,
                        ],
                        'array' => [
                            'width' => []
                        ],
                    ]
                ],
                [
                    'numeric-string' => [
                        'width' => 100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ]
                ]
            ],
            'variants unset property' => [
                [
                    'variants' => [
                        'unset-all' => [
                            'breakpoint' => 'unset',
                            'width' => 'unset'
                        ],
                        'unset-breakpoint' => [
                            'breakpoint' => 'unset',
                            'width' => 1100
                        ],
                        'unset-width' => [
                            'breakpoint' => 1200,
                            'width' => 'unset'
                        ]
                    ]
                ],
                [
                    'unset-breakpoint' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ]
                ]
            ],
            'multiplier' => [
                [
                    'variants' => [
                        'default' => [
                            'width' => 1100
                        ]
                    ],
                    'multiplier' => [
                        'default' => 0.5
                    ]
                ],
                [
                    'default' => [
                        'width' => 550,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1
                            ]
                        ]
                    ]
                ]
            ],
            'multiplier on no existent variants' => [
                [
                    'variants' => [
                        'default' => [
                            'width' => 1100
                        ]
                    ],
                    'multiplier' => [
                        'doesnotexist' => 0.5
                    ]
                ],
                [
                    'default' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ]
                ]
            ],
            'multiplier input types' => [
                [
                    'variants' => [
                        'numeric-string' => [
                            'width' => 1100
                        ],
                        'string' => [
                            'width' => 1100
                        ],
                        'px' => [
                            'width' => 1100
                        ],
                        'percent' => [
                            'width' => 1100
                        ],
                        'null' => [
                            'width' => 1100
                        ],
                        'array' => [
                            'width' => 1100
                        ]
                    ],
                    'multiplier' => [
                        'numeric-string' => '0.5',
                        'string' => 'foo',
                        'px' => '0.5px',
                        'percent' => '50%',
                        'null' => null,
                        'array' => []
                    ]
                ],
                [
                    'numeric-string' => [
                        'width' => 550,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ],
                    'string' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ],
                    'px' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ],
                    'percent' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ],
                    'null' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ],
                    'array' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ]
                ]
            ],
            'corrections' => [
                [
                    'variants' => [
                        'default' => [
                            'width' => 1100
                        ]
                    ],
                    'corrections' => [
                        'default' => 100
                    ]
                ],
                [
                    'default' => [
                        'width' => 1000,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ]
                ]
            ],
            'corrections on no existent variants' => [
                [
                    'variants' => [
                        'default' => [
                            'width' => 1100
                        ]
                    ],
                    'corrections' => [
                        'doesnotexist' => 10
                    ]
                ],
                [
                    'default' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ]
                ]
            ],
            'corrections input types' => [
                [
                    'variants' => [
                        'numeric-string' => [
                            'width' => 1100
                        ],
                        'string' => [
                            'width' => 1100
                        ],
                        'px' => [
                            'width' => 1100
                        ],
                        'percent' => [
                            'width' => 1100
                        ],
                        'null' => [
                            'width' => 1100
                        ],
                        'array' => [
                            'width' => 1100
                        ]
                    ],
                    'corrections' => [
                        'numeric-string' => '100',
                        'string' => 'foo',
                        'px' => '0.5px',
                        'percent' => '50%',
                        'null' => null,
                        'array' => []
                    ]
                ],
                [
                    'numeric-string' => [
                        'width' => 1000,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ],
                    'string' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ],
                    'px' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ],
                    'percent' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ],
                    'null' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ],
                    'array' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ]
                ]
            ],
            'gutter' => [
                [
                    'variants' => [
                        'default' => [
                            'width' => 1100
                        ]
                    ],
                    'gutters' => [
                        'default' => 40
                    ]
                ],
                [
                    'default' => [
                        'width' => 1060,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1
                            ]
                        ]
                    ]
                ]
            ],
            'gutter on no existent variants' => [
                [
                    'variants' => [
                        'default' => [
                            'width' => 1100
                        ]
                    ],
                    'gutters' => [
                        'doesnotexist' => 40
                    ]
                ],
                [
                    'default' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1
                            ]
                        ]
                    ]
                ]
            ],
            'gutter input types' => [
                [
                    'variants' => [
                        'numeric-string' => [ 'width' => 1100 ],
                        'string' => [ 'width' => 1100 ],
                        'px' => [ 'width' => 1100 ],
                        'percent' => [ 'width' => 1100 ],
                        'null' => [ 'width' => 1100 ],
                        'array' => [ 'width' => 1100 ]
                    ],
                    'gutters' => [
                        'numeric-string' => '40',
                        'string' => 'foo',
                        'px' => '0.5px',
                        'percent' => '50%',
                        'null' => null,
                        'array' => []
                    ]
                ],
                [
                    'numeric-string' => [
                        'width' => 1060,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1
                            ]
                        ]
                    ],
                    'string' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1
                            ]
                        ]
                    ],
                    'px' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1
                            ]
                        ]
                    ],
                    'percent' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1
                            ]
                        ]
                    ],
                    'null' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1
                            ]
                        ]
                    ],
                    'array' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1
                            ]
                        ]
                    ],
                ]
            ],
            'multiplier and gutter' => [
                [
                    'variants' => [
                        'default' => [ 'width' => 1100 ],
                        'large' => [ 'width' => 920 ]
                    ],
                    'multiplier' => [
                        'default' => 0.5,
                        'large' => 0.75
                    ],
                    'gutters' => [
                        'default' => 40,
                        'large' => 40
                    ]
                ],
                [
                    'default' => [
                        'width' => 530,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1
                            ]
                        ]
                    ],
                    'large' => [
                        'width' => 660,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1
                            ]
                        ]
                    ]
                ]
            ],
            'multiplier and corrections' => [
                [
                    'variants' => [
                        'default' => [
                            'width' => 1100
                        ]
                    ],
                    'multiplier' => [
                        'default' => 0.5
                    ],
                    'corrections' => [
                        'default' => 10
                    ]
                ],
                [
                    'default' => [
                        'width' => 540,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1
                            ]
                        ]
                    ]
                ]
            ],
            'multiplier, gutter and corrections' => [
                [
                    'variants' => [
                        'default' => [
                            'width' => 1100
                        ]
                    ],
                    'multiplier' => [
                        'default' => 0.5
                    ],
                    'gutters' => [
                        'default' => 40
                    ],
                    'corrections' => [
                        'default' => 10
                    ]
                ],
                [
                    'default' => [
                        'width' => 520,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ]
                ]
            ],
            'sizes' => [
                [
                    'variants' => [
                        'default' => [
                            'width' => 1100,
                            'sizes' => [
                                '2x' => [
                                    'multiplier' => 2
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'default' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ],
                            '2x' => [
                                'multiplier' => 2,
                            ]
                        ]
                    ]
                ]
            ],
            'sizes-multiplier' => [
                [
                    'variants' => [
                        'default' => [
                            'width' => 1100,
                            'sizes' => [
                                '1x' => [
                                    'multiplier' => '2'
                                ],
                                '2x' => [
                                    'multiplier' => 'foo'
                                ],
                                '3x' => [
                                    'multiplier' => '0.5px'
                                ],
                                '4x' => [
                                    'multiplier' => '50%'
                                ],
                                '5x' => [
                                    'multiplier' => null
                                ],
                                '6x' => [
                                    'multiplier' => []
                                ],
                                '7x' => [
                                    'multiplier' => -2
                                ],
                                '8x' => [
                                    'multiplier' => 0.5
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'default' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 2,
                            ]
                        ]
                    ]
                ]
            ],
            'sizes-invalid' => [
                [
                    'variants' => [
                        'default' => [
                            'width' => 1100,
                            'sizes' => [
                                '2x' => [
                                ],
                                '3x' => [
                                    'foo' => 'bar'
                                ],
                                '4x' => [
                                    'multiplier' => 'unset'
                                ],
                                '5x' => [
                                    'multiplier' => 1,
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'default' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ],
                            '5x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ]
                ]
            ],
            'sizes-invalid-keys' => [
                [
                    'variants' => [
                        'default' => [
                            'width' => 1100,
                            'sizes' => [
                                'superhdpix' => [
                                    'multiplier' => 1
                                ],
                                '13hdpi' => [
                                    'multiplier' => 1
                                ],
                                10 => [
                                    'multiplier' => 1
                                ],
                                '0.5x' => [
                                    'multiplier' => 1
                                ],
                                '10.1234x' => [
                                    'multiplier' => 1
                                ],
                                '123,456.00x' => [
                                    'multiplier' => 1
                                ],
                                '654.321,00x' => [
                                    'multiplier' => 1
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'default' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ]
                ]
            ],
            'sizes-add-1x' => [
                [
                    'variants' => [
                        'default' => [
                            'width' => 1100,
                            'sizes' => [
                                '2x' => [
                                    'multiplier' => 2
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'default' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ],
                            '2x' => [
                                'multiplier' => 2,
                            ]
                        ]
                    ]
                ]
            ],
            'sizes-sorting' => [
                [
                    'variants' => [
                        'default' => [
                            'width' => 1100,
                            'sizes' => [
                                '1.5x' => [
                                    'multiplier' => 1
                                ],
                                '2.5x' => [
                                    'multiplier' => 1
                                ],
                                '2x' => [
                                    'multiplier' => 1
                                ],
                                '1x' => [
                                    'multiplier' => 1
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'default' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ],
                            '1.5x' => [
                                'multiplier' => 1,
                            ],
                            '2x' => [
                                'multiplier' => 1,
                            ],
                            '2.5x' => [
                                'multiplier' => 1,
                            ],
                        ]
                    ]
                ]
            ],
            'aspect-ratio' => [
                [
                    'variants' => [
                        'float' => [
                            'width' => 1100,
                            'aspectRatio' => 1.3333333333333,
                        ],
                        'integer' => [
                            'width' => 1100,
                            'aspectRatio' => 1,
                        ],
                        'invalid' => [
                            'width' => 1100,
                            'aspectRatio' => 'invalid',
                        ]
                    ]
                ],
                [
                    'float' => [
                        'width' => 1100,
                        'aspectRatio' => 1.3333333333333,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ],
                    'integer' => [
                        'width' => 1100,
                        'aspectRatio' => 1.0,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ],
                    'invalid' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * @param array $data
     * @param array $expectedResult
     * @dataProvider getStackedImageVariantsTestDataProvider
     * @test
     */
    public function getStackedImageVariantsTest(array $data, array $expectedResult): void
    {
        $result = null;
        foreach ($data as $datasetKey => $datasetConfig) {
            $variants = isset($datasetConfig['variants']) ? $datasetConfig['variants'] : $result;
            $multiplier = isset($datasetConfig['multiplier']) ? $datasetConfig['multiplier'] : null;
            $corrections = isset($datasetConfig['corrections']) ? $datasetConfig['corrections'] : null;
            $gutters = isset($datasetConfig['gutters']) ? $datasetConfig['gutters'] : null;
            $result = ImageVariantsUtility::getImageVariants($variants, $multiplier, $gutters, $corrections);
        }
        self::assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public function getStackedImageVariantsTestDataProvider(): array
    {
        return [
            'multiplier' => [
                [
                    'base' => [
                        'variants' => [ 'default' => [ 'breakpoint' => 1200, 'width' => 1100 ] ],
                        'multiplier' => [ 'default' => 0.5 ],
                    ],
                    'extend' => [
                        'multiplier' => [ 'default' => 0.5 ],
                    ],
                ],
                [
                    'default' => [
                        'breakpoint' => 1200,
                        'width' => 275,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1
                            ]
                        ]
                    ],
                ],
            ],
            'multiplier, gutter, corrections, sizes' => [
                [
                    'base' => [
                        'variants' => [
                            'default' => [
                                'width' => 1100 ,
                                'sizes' => [
                                    '1.5x' => [ 'multiplier' => 1.5 ],
                                    '2x' => [ 'multiplier' => 2 ]
                                ]
                            ]
                        ],
                        'multiplier' => [ 'default' => 0.5 ],
                        'gutters' => [ 'default' => 40 ],
                        'corrections' => [ 'default' => 10 ],
                    ],
                    'multiplier-gutter-corrections' => [
                        'multiplier' => [ 'default' => 0.5 ],
                        'gutters' => [ 'default' => 40 ],
                        'corrections' => [ 'default' => 10 ],
                    ],
                ],
                [
                    'default' => [
                        'width' => 230,
                        'sizes' => [
                            '1x' => [ 'multiplier' => 1 ],
                            '1.5x' => [ 'multiplier' => 1.5 ],
                            '2x' => [ 'multiplier' => 2 ]
                        ]
                    ]
                ]
            ],
            'keep-aspect-ratio' => [
                [
                    'base' => [
                        'variants' => [
                            'default' => [
                                'width' => 1100,
                                'aspectRatio' => 1.5
                            ]
                        ]
                    ],
                    'extend' => [
                        'multiplier' => [ 'default' => 0.5 ]
                    ]
                ],
                [
                    'default' => [
                        'width' => 550,
                        'aspectRatio' => 1.5,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * @param mixed $input
     * @param bool $expectedResult
     * @dataProvider isValidSizeKeyTestDataProvider
     * @test
     */
    public function isValidSizeKeyTest($input, bool $expectedResult): void
    {
        $result = ImageVariantsUtility::isValidSizeKey($input);
        self::assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public function isValidSizeKeyTestDataProvider(): array
    {
        return [
            'valid 1x' => [ '1x', true ],
            'valid 1.5x' => [ '1.5x', true ],
            'invalid superhdpix' => [ 'superhdpix', false ],
            'invalid 13hdpi' => [ '13hdpi', false ],
            'invalid 10' => [ 10, false ],
            'invalid 0.5x' => [ '0.5x', false ],
            'invalid 10.1234x' => [ '10.1234x', false ],
            'invalid 123,456.00x' => [ '123,456.00x', false ],
            'invalid 654.321,00x' => [ '654.321,00x', false ],
            'invalid []' => [ [], false ],
            'invalid true' => [ true, false ],
        ];
    }
}
