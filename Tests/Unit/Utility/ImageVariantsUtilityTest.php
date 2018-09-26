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
    public function getImageVariantsTestDataProvider()
    {
        return [
            'empty' => [
                [],
                [
                    'default' => [ 'breakpoint' => 1200, 'width' => 1100 ],
                    'large' => [ 'breakpoint' => 992, 'width' => 920 ],
                    'medium' => [ 'breakpoint' => 768, 'width' => 680 ],
                    'small' => [ 'breakpoint' => 576, 'width' => 500 ],
                    'extrasmall' => [ 'width' => 374 ]
                ]
            ],
            'invalid dataset' => [
                [
                    'variants' => 'string',
                    'multiplier' => 'string',
                    'corrections' => 'string'
                ],
                [
                    'default' => [ 'breakpoint' => 1200, 'width' => 1100 ],
                    'large' => [ 'breakpoint' => 992, 'width' => 920 ],
                    'medium' => [ 'breakpoint' => 768, 'width' => 680 ],
                    'small' => [ 'breakpoint' => 576, 'width' => 500 ],
                    'extrasmall' => [ 'width' => 374 ]
                ]
            ],
            'variants' => [
                [
                    'variants' => [
                        'default' => [ 'breakpoint' => 1200, 'width' => 1100 ],
                    ]
                ],
                [
                    'default' => [ 'breakpoint' => 1200, 'width' => 1100 ]
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
                        'width' => 100
                    ]
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
                    'unset-breakpoint' => [ 'width' => 1100 ]
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
                    'default' => [ 'width' => 550 ]
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
                    'default' => [ 'width' => 1100 ]
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
                    'numeric-string' => [ 'width' => 550 ],
                    'string' => [ 'width' => 1100 ],
                    'px' => [ 'width' => 1100 ],
                    'percent' => [ 'width' => 1100 ],
                    'null' => [ 'width' => 1100 ],
                    'array' => [ 'width' => 1100 ]
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
                    'default' => [ 'width' => 1000 ]
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
                    'default' => [ 'width' => 1100 ]
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
                    'numeric-string' => [ 'width' => 1000 ],
                    'string' => [ 'width' => 1100 ],
                    'px' => [ 'width' => 1100 ],
                    'percent' => [ 'width' => 1100 ],
                    'null' => [ 'width' => 1100 ],
                    'array' => [ 'width' => 1100 ]
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
                    'default' => [ 'width' => 1100 ]
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
                    'default' => [ 'width' => 1100 ]
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
                    'numeric-string' => [ 'width' => 1100 ],
                    'string' => [ 'width' => 1100 ],
                    'px' => [ 'width' => 1100 ],
                    'percent' => [ 'width' => 1100 ],
                    'null' => [ 'width' => 1100 ],
                    'array' => [ 'width' => 1100 ]
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
                    'default' => [ 'width' => 530 ],
                    'large' => [ 'width' => 680 ]
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
                    'default' => [ 'width' => 540 ]
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
                    'default' => [ 'width' => 520 ]
                ]
            ]
        ];
    }
}
