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
        $result = ImageVariantsUtility::getImageVariants($data['variants'], $data['multiplier'], $data['corrections']);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public function getImageVariantsTestDataProvider()
    {
        return [
            'empty' => [
                [
                    'variants' => [],
                    'multiplier' => [],
                    'corrections' => []
                ],
                [
                    'default' => [ 'breakpoint' => 1200, 'width' => 1100 ],
                    'large' => [ 'breakpoint' => 992, 'width' => 920 ],
                    'medium' => [ 'breakpoint' => 768, 'width' => 680 ],
                    'small' => [ 'breakpoint' => 576, 'width' => 500 ],
                    'extrasmall' => [ 'width' => 374 ]
                ]
            ],
            'custom variants' => [
                [
                    'variants' => [
                        'default' => [ 'breakpoint' => 1200, 'width' => 1100 ],
                    ],
                    'multiplier' => [],
                    'corrections' => []
                ],
                [
                    'default' => [ 'breakpoint' => 1200, 'width' => 1100 ]
                ]
            ]
        ];
    }
}
