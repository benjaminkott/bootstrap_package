<?php

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
     * @param string $expectedResult
     * @dataProvider getImageVariantsTestDataProvider
     * @test
     */
    public function getImageVariantsTest(array $data, array $expectedResult)
    {
        $variants = isset($data['variants']) ? $data['variants'] : null;
        $multiplier = isset($data['multiplier']) ? $data['multiplier'] : null;
        $corrections = isset($data['corrections']) ? $data['corrections'] : null;
        $gutters = isset($data['gutters']) ? $data['gutters'] : null;
        $result = ImageVariantsUtility::getImageVariants($variants, $multiplier, $gutters, $corrections);
        $this->assertSame($expectedResult, $result);
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
                    'default' => [ 'breakpoint' => 1200, 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ],
                    'large' => [ 'breakpoint' => 992, 'width' => 920, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 920 ] ] ],
                    'medium' => [ 'breakpoint' => 768, 'width' => 680, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 680 ] ] ],
                    'small' => [ 'breakpoint' => 576, 'width' => 500, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 500 ] ] ],
                    'extrasmall' => [ 'width' => 374, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 374 ] ] ]
                ]
            ],
            'invalid dataset' => [
                [
                    'variants' => 'string',
                    'multiplier' => 'string',
                    'corrections' => 'string'
                ],
                [
                    'default' => [ 'breakpoint' => 1200, 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ],
                    'large' => [ 'breakpoint' => 992, 'width' => 920, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 920 ] ] ],
                    'medium' => [ 'breakpoint' => 768, 'width' => 680, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 680 ] ] ],
                    'small' => [ 'breakpoint' => 576, 'width' => 500, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 500 ] ] ],
                    'extrasmall' => [ 'width' => 374, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 374 ] ] ]
                ]
            ],
            'variants' => [
                [
                    'variants' => [
                        'default' => [ 'breakpoint' => 1200, 'width' => 1100 ],
                    ]
                ],
                [
                    'default' => [ 'breakpoint' => 1200, 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ]
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
                    'numeric-string' => [ 'width' => 100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 100 ] ] ]
                ]
            ],
            'variants unset property' => [
                [
                    'variants' => [
                        'unset-all' => [ 'breakpoint' => 'unset', 'width' => 'unset' ],
                        'unset-breakpoint' => [ 'breakpoint' => 'unset', 'width' => 1100 ],
                        'unset-width' => [ 'breakpoint' => 1200, 'width' => 'unset' ]
                    ]
                ],
                [
                    'unset-breakpoint' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ]
                ]
            ],
            'multiplier' => [
                [
                    'variants' => [
                        'default' => [ 'width' => 1100 ]
                    ],
                    'multiplier' => [
                        'default' => 0.5
                    ]
                ],
                [
                    'default' => [ 'width' => 550, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 550 ] ] ]
                ]
            ],
            'multiplier on no existent variants' => [
                [
                    'variants' => [
                        'default' => [ 'width' => 1100 ]
                    ],
                    'multiplier' => [
                        'doesnotexist' => 0.5
                    ]
                ],
                [
                    'default' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ]
                ]
            ],
            'multiplier input types' => [
                [
                    'variants' => [
                        'numeric-string' => [ 'width' => 1100 ],
                        'string' => [ 'width' => 1100 ],
                        'px' => [ 'width' => 1100 ],
                        'percent' => [ 'width' => 1100 ],
                        'null' => [ 'width' => 1100 ],
                        'array' => [ 'width' => 1100 ]
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
                    'numeric-string' => [ 'width' => 550, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 550 ] ] ],
                    'string' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ],
                    'px' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ],
                    'percent' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ],
                    'null' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ],
                    'array' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ]
                ]
            ],
            'corrections' => [
                [
                    'variants' => [
                        'default' => [ 'width' => 1100 ]
                    ],
                    'corrections' => [
                        'default' => 100
                    ]
                ],
                [
                    'default' => [ 'width' => 1000, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1000 ] ] ]
                ]
            ],
            'corrections on no existent variants' => [
                [
                    'variants' => [
                        'default' => [ 'width' => 1100 ]
                    ],
                    'corrections' => [
                        'doesnotexist' => 10
                    ],
                ],
                [
                    'default' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ]
                ]
            ],
            'corrections input types' => [
                [
                    'variants' => [
                        'numeric-string' => [ 'width' => 1100 ],
                        'string' => [ 'width' => 1100 ],
                        'px' => [ 'width' => 1100 ],
                        'percent' => [ 'width' => 1100 ],
                        'null' => [ 'width' => 1100 ],
                        'array' => [ 'width' => 1100 ]
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
                    'numeric-string' => [ 'width' => 1000, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1000 ] ] ],
                    'string' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ],
                    'px' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ],
                    'percent' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ],
                    'null' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ],
                    'array' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ]
                ]
            ],
            'gutter' => [
                [
                    'variants' => [
                        'default' => [ 'width' => 1100 ]
                    ],
                    'gutters' => [
                        'default' => 40
                    ]
                ],
                [
                    'default' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ]
                ]
            ],
            'gutter on no existent variants' => [
                [
                    'variants' => [
                        'default' => [ 'width' => 1100 ]
                    ],
                    'gutters' => [
                        'doesnotexist' => 40
                    ],
                ],
                [
                    'default' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ]
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
                    'numeric-string' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ],
                    'string' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ],
                    'px' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ],
                    'percent' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ],
                    'null' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ],
                    'array' => [ 'width' => 1100, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 1100 ] ] ]
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
                    'default' => [ 'width' => 530, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 530 ] ] ],
                    'large' => [ 'width' => 680, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 680 ] ] ]
                ]
            ],
            'multiplier and corrections' => [
                [
                    'variants' => [
                        'default' => [ 'width' => 1100 ]
                    ],
                    'multiplier' => [
                        'default' => 0.5
                    ],
                    'corrections' => [
                        'default' => 10
                    ]
                ],
                [
                    'default' => [ 'width' => 540, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 540 ] ] ]
                ]
            ],
            'multiplier, gutter and corrections' => [
                [
                    'variants' => [
                        'default' => [ 'width' => 1100 ]
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
                    'default' => [ 'width' => 520, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 520 ] ] ]
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
                                'width' => 1100,
                            ],
                            '2x' => [
                                'multiplier' => 2,
                                'width' => 2200,
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
                                '1x' => [ 'multiplier' => '2' ],
                                '2x' => [ 'multiplier' => 'foo' ],
                                '3x' => [ 'multiplier' => '0.5px' ],
                                '4x' => [ 'multiplier' => '50%' ],
                                '5x' => [ 'multiplier' => null ],
                                '6x' => [ 'multiplier' => [] ],
                                '7x' => [ 'multiplier' => -2 ],
                                '8x' => [ 'multiplier' => 0.5 ],
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
                                'width' => 2200,
                            ],
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
                                '2x' => [ ],
                                '3x' => [ 'width' => '300' ],
                                '4x' => [ 'multiplier' => 'unset' ],
                                '5x' => [ 'foo' => 'bar' ],
                                '6x' => [ 'multiplier' => 1, 'width' => 300, 'foo' => 'bar' ],
                            ]
                        ]
                    ],
                ],
                [
                    'default' => [
                        'width' => 1100,
                        'sizes' => [
                            '1x' => [
                                'multiplier' => 1,
                                'width' => 1100,
                            ],
                            '6x' => [
                                'multiplier' => 1,
                                'width' => 1100,
                            ],
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
                                'superhdpix' => [ 'multiplier' => 1 ],
                                '13hdpi' => [ 'multiplier' => 1 ],
                                10 => [ 'multiplier' => 1 ],
                                '0.5x' => [ 'multiplier' => 1 ],
                                '10.1234x' => [ 'multiplier' => 1 ],
                                '123,456.00x' => [ 'multiplier' => 1 ],
                                '654.321,00x' => [ 'multiplier' => 1 ],
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
                                'width' => 1100,
                            ],
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
                                '2x' => [ 'multiplier' => 2 ],
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
                                'width' => 1100,
                            ],
                            '2x' => [
                                'multiplier' => 2,
                                'width' => 2200,
                            ],
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
                                '1.5x' => [ 'multiplier' => 1 ],
                                '2.5x' => [ 'multiplier' => 1 ],
                                '2x' => [ 'multiplier' => 1 ],
                                '1x' => [ 'multiplier' => 1 ],
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
                                'width' => 1100,
                            ],
                            '1.5x' => [
                                'multiplier' => 1,
                                'width' => 1100,
                            ],
                            '2x' => [
                                'multiplier' => 1,
                                'width' => 1100,
                            ],
                            '2.5x' => [
                                'multiplier' => 1,
                                'width' => 1100,
                            ],
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * @param array $data
     * @param string $expectedResult
     * @dataProvider getStackedImageVariantsTestDataProvider
     * @test
     */
    public function getStackedImageVariantsTest(array $data, array $expectedResult)
    {
        $result = null;
        foreach ($data as $datasetKey => $datasetConfig) {
            $variants = isset($datasetConfig['variants']) ? $datasetConfig['variants'] : $result;
            $multiplier = isset($datasetConfig['multiplier']) ? $datasetConfig['multiplier'] : null;
            $corrections = isset($datasetConfig['corrections']) ? $datasetConfig['corrections'] : null;
            $gutters = isset($datasetConfig['gutters']) ? $datasetConfig['gutters'] : null;
            $result = ImageVariantsUtility::getImageVariants($variants, $multiplier, $gutters, $corrections);
        }
        $this->assertSame($expectedResult, $result);
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
                    'default' => [ 'breakpoint' => 1200, 'width' => 275, 'sizes' => [ '1x' => [ 'multiplier' => 1, 'width' => 275 ] ] ],
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
                            '1x' => [ 'multiplier' => 1, 'width' => 230 ],
                            '1.5x' => [ 'multiplier' => 1.5, 'width' => 345 ],
                            '2x' => [ 'multiplier' => 2, 'width' => 460 ]
                        ]
                    ]
                ]
            ],
        ];
    }
}
