<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Utility;

/**
 * Calculate image variants
 */
class ImageVariantsUtility
{
    /**
     * @var array
     */
    protected static $allowedVariantProperties = [
        'breakpoint',
        'width'
    ];

    /**
     * @var array
     */
    protected static $defaultVariants = [
        'default' => [
            'breakpoint' => 1200,
            'width' => 1100
        ],
        'large' => [
            'breakpoint' => 992,
            'width' => 920
        ],
        'medium' => [
            'breakpoint' => 768,
            'width' => 680
        ],
        'small' => [
            'breakpoint' => 576,
            'width' => 500
        ],
        'extrasmall' => [
            'width' => 374
        ]
    ];

    /**
     * @param array $variants
     * @param array $multiplier
     * @param array $gutter
     * @param array $corrections
     * @return array
     */
    public static function getImageVariants($variants = [], $multiplier = [], $gutter = [], $corrections = []): array
    {
        $variants = self::processVariants($variants);
        $variants = self::addGutter($variants, $gutter);
        $variants = self::processMultiplier($variants, $multiplier);
        $variants = self::removeGutter($variants, $gutter);
        $variants = self::processCorrections($variants, $corrections);
        return $variants;
    }

    /**
     * @param array $variants
     * @return array
     */
    protected static function processVariants($variants): array
    {
        $variants = is_array($variants) && !empty($variants) ? $variants : self::$defaultVariants;
        foreach ($variants as $variant => $properties) {
            if (is_array($properties)) {
                foreach ($properties as $key => $value) {
                    if ($value === 'unset' || !in_array($key, self::$allowedVariantProperties, true)) {
                        unset($variants[$variant][$key]);
                        continue;
                    }
                    if (is_numeric($value) && $value > 0) {
                        $variants[$variant][$key] = (int) $value;
                    } else {
                        unset($variants[$variant][$key]);
                    }
                }
                if (empty($variants[$variant]) || !isset($variants[$variant]['width'])) {
                    unset($variants[$variant]);
                }
            } else {
                unset($variants[$variant]);
            }
        }
        return $variants;
    }

    /**
     * @param array $variants
     * @param array $gutter
     * @return array
     */
    protected static function addGutter($variants, $gutter): array
    {
        $gutter = is_array($gutter) ? $gutter : [];
        foreach ($gutter as $variant => $value) {
            if (is_numeric($value) && $value > 0 && isset($variants[$variant]['width'])) {
                $variants[$variant]['width'] = (int) ceil($variants[$variant]['width'] + $value);
            }
        }
        return $variants;
    }

    /**
     * @param array $variants
     * @param array $gutter
     * @return array
     */
    protected static function removeGutter($variants, $gutter): array
    {
        $gutter = is_array($gutter) ? $gutter : [];
        foreach ($gutter as $variant => $value) {
            if (is_numeric($value) && $value > 0 && isset($variants[$variant]['width'])) {
                $variants[$variant]['width'] = (int) ceil($variants[$variant]['width'] - $value);
            }
        }
        return $variants;
    }

    /**
     * @param array $variants
     * @param array $multiplier
     * @return array
     */
    protected static function processMultiplier($variants, $multiplier): array
    {
        $multiplier = is_array($multiplier) ? $multiplier : [];
        foreach ($multiplier as $variant => $value) {
            if (is_numeric($value) && $value > 0 && isset($variants[$variant]['width'])) {
                $variants[$variant]['width'] = (int) ceil($variants[$variant]['width'] * $value);
            }
        }
        return $variants;
    }

    /**
     * @param array $variants
     * @param array $corrections
     * @return array
     */
    protected static function processCorrections($variants, $corrections): array
    {
        $corrections = is_array($corrections) ? $corrections : [];
        foreach ($corrections as $variant => $value) {
            if (is_numeric($value) && $value > 0 && isset($variants[$variant]['width'])) {
                $variants[$variant]['width'] -= $value;
            }
        }
        return $variants;
    }
}
