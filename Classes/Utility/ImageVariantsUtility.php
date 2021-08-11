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
        'width',
        'aspectRatio',
        'sizes',
    ];

    /**
     * @var array
     */
    protected static $defaultVariants = [
        'default' => [
            'breakpoint' => 1400,
            'width' => 1280
        ],
        'xlarge' => [
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
     * @param array|null $variants
     * @param array|null $multiplier
     * @param array|null $gutters
     * @param array|null $corrections
     * @param float|null $aspectRatio
     * @return array
     */
    public static function getImageVariants(?array $variants = null, ?array $multiplier = null, ?array $gutters = null, ?array $corrections = null, ?float $aspectRatio = null): array
    {
        $variants = $variants !== null ? $variants : [];
        $variants = self::processVariants($variants);
        $variants = self::processResolutions($variants);
        if ($gutters !== null) {
            $variants = self::removeGutters($variants, $gutters);
        }
        if ($multiplier !== null) {
            $variants = self::processMultiplier($variants, $multiplier);
        }
        if ($corrections !== null) {
            $variants = self::processCorrections($variants, $corrections);
        }
        if ($aspectRatio !== null) {
            $variants = self::processAspectRatio($variants, $aspectRatio);
        }
        return $variants;
    }

    /**
     * @param array $variants
     * @return array
     */
    protected static function processResolutions(array $variants): array
    {
        foreach ($variants as $variant => $properties) {
            if (!array_key_exists('sizes', $properties)) {
                $properties['sizes'] = [];
            }
            $properties['sizes'] = self::processSizes($properties['sizes']);
            $variants[$variant] = $properties;
        }
        return $variants;
    }

    /**
     * @param array $sizes
     * @return array
     */
    protected static function processSizes(array $sizes): array
    {
        $resultSizes = [];
        $workingSizes = [];
        foreach ($sizes as $key => $settings) {
            if (!array_key_exists('multiplier', $settings) ||
                !is_numeric($settings['multiplier']) ||
                $settings['multiplier'] < 1 ||
                !self::isValidSizeKey($key)
            ) {
                continue;
            }
            $settings['multiplier'] = gettype($settings['multiplier']) === 'double' ? (float) $settings['multiplier'] : (int) $settings['multiplier'];
            $workingSizes[substr($key, 0, -1) . ''] = [
                'multiplier' => 1 * $settings['multiplier'],
            ];
        }

        if (!isset($workingSizes['1'])) {
            $workingSizes['1'] = ['multiplier' => 1];
        }
        ksort($workingSizes);
        foreach ($workingSizes as $workingKey => $workingSettings) {
            $resultSizes[$workingKey . 'x'] = $workingSettings;
        }

        return $resultSizes;
    }

    /**
     * @param array $variants
     * @return array
     */
    protected static function processVariants(array $variants): array
    {
        $variants = count($variants) > 0 ? $variants : self::$defaultVariants;
        foreach ($variants as $variant => $properties) {
            if (!is_array($properties)) {
                unset($variants[$variant]);
                continue;
            }
            foreach ($properties as $key => $value) {
                if (!in_array($key, self::$allowedVariantProperties, true)) {
                    unset($variants[$variant][$key]);
                    continue;
                }
                if ($key === 'sizes') {
                    continue;
                } elseif ($key === 'aspectRatio') {
                    if (is_numeric($value) && $value > 0) {
                        $variants[$variant][$key] = (float) $value;
                    } else {
                        unset($variants[$variant][$key]);
                    }
                } elseif (is_numeric($value) && $value > 0) {
                    $variants[$variant][$key] = (int) $value;
                } else {
                    unset($variants[$variant][$key]);
                }
            }
            if (count($variants[$variant]) === 0 || !isset($variants[$variant]['width'])) {
                unset($variants[$variant]);
            }
        }
        return $variants;
    }

    /**
     * @param array $variants
     * @param array $gutters
     * @return array
     */
    protected static function removeGutters(array $variants, array $gutters): array
    {
        foreach ($gutters as $variant => $value) {
            if (is_numeric($value) && $value > 0 && isset($variants[$variant]['width'])) {
                $variants[$variant]['width'] = (int) ceil($variants[$variant]['width'] - (float) $value);
            }
        }
        return $variants;
    }

    /**
     * @param array $variants
     * @param array $multiplier
     * @return array
     */
    protected static function processMultiplier(array $variants, array $multiplier): array
    {
        foreach ($multiplier as $variant => $value) {
            if (is_numeric($value) && $value > 0 && isset($variants[$variant]['width'])) {
                $variants[$variant]['width'] = (int) ceil($variants[$variant]['width'] * (float) $value);
            }
        }
        return $variants;
    }

    /**
     * @param array $variants
     * @param array $corrections
     * @return array
     */
    protected static function processCorrections(array $variants, array $corrections): array
    {
        foreach ($corrections as $variant => $value) {
            if (is_numeric($value) && $value > 0 && isset($variants[$variant]['width'])) {
                $variants[$variant]['width'] -= $value;
            }
        }
        return $variants;
    }

    /**
     * @param array $variants
     * @param float $aspectRatio
     * @return array
     */
    protected static function processAspectRatio(array $variants, float $aspectRatio): array
    {
        if ($aspectRatio > 0) {
            foreach ($variants as $variant => $value) {
                $variants[$variant]['aspectRatio'] = $aspectRatio;
            }
        }
        return $variants;
    }

    /**
     * @param mixed $key
     * @return bool
     */
    public static function isValidSizeKey($key): bool
    {
        return !(
            !is_string($key) ||
            substr($key, -1, 1) !== 'x' ||
            !is_numeric(substr($key, 0, -1)) ||
            (float) substr($key, 0, -1) < 1 ||
            (float) substr($key, 0, -1) !== round((float) substr($key, 0, -1), 1)
        );
    }
}
