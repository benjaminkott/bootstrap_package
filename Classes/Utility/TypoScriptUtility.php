<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Utility;

use Psr\Http\Message\ServerRequestInterface;

/**
 * TypoScriptUtility
 */
class TypoScriptUtility
{
    public static function getSetup(ServerRequestInterface $request): array
    {
        return $request->getAttribute('frontend.typoscript')->getSetupArray();
    }

    public static function getConstants(ServerRequestInterface $request): array
    {
        return $request->getAttribute('frontend.typoscript')->getFlatSettings();
    }

    public static function getConstantsByPrefix(ServerRequestInterface $request, string $prefix, bool $stripPrefix = true): array
    {
        $constants = array_filter(
            self::getConstants($request),
            function (string $name) use ($prefix) {
                return strpos($name, $prefix . '.') === 0;
            },
            ARRAY_FILTER_USE_KEY
        );

        if ($stripPrefix === false) {
            return $constants;
        }

        $processedConstants = [];
        foreach ($constants as $name => $value) {
            $processedConstants[substr($name, strlen($prefix . '.'))] = $value;
        }

        return $processedConstants;
    }

    public static function unflatten(array $input): array
    {
        $output = [];
        foreach ($input as $key => $value) {
            $parts = explode('.', $key);
            $nested = &$output;
            while (count($parts) > 1) {
                $nested = &$nested[array_shift($parts)];
                if (!is_array($nested)) {
                    $nested = [];
                }
            }
            $nested[array_shift($parts)] = $value;
        }
        return $output;
    }
}
