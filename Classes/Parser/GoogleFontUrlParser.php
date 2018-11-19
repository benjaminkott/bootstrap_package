<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Parser;

/**
 * GoogleFontUrlParser
 */
class GoogleFontUrlParser
{
    /**
     * Returns an array containing an array of fonts and weights.
     *
     * @param $url
     * @return array
     */
    public static function parse($url)
    {
        $fonts = [];
        foreach (explode('|', self::getFamilyParameter($url)) as $googleFont) {
            $fonts[] = explode(':', $googleFont);
        }

        return $fonts;
    }

    /**
     * Returns an array containing families and its associated weights.
     *
     * @param $url
     * @return array
     */
    public static function parseSimple($url)
    {
        $fonts = [];
        foreach (explode('|', self::getFamilyParameter($url)) as $googleFont) {
            $fonts[] = $googleFont;
        }

        return $fonts;
    }

    /**
     * @param $url
     * @return string
     */
    public static function getFamilyParameter($url)
    {
        $parts = parse_url($url);
        parse_str($parts['query'], $query);

        return urldecode($query['family']);
    }
}
