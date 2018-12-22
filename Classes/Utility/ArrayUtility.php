<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Utility;

/**
 * ExternalMediaUtility
 */
class ArrayUtility
{

    /**
     * Flatten an array
     *
     * @param array $array
     * @return array
     */
    public static function flatten(array $array)
    {
        $flattenArray = [];
        while (count($array)) {
            $value = array_shift($array);
            if (is_array($value)) {
                foreach ($value as $sub) {
                    $array[] = $sub;
                }
            } else {
                $flattenArray[] = $value;
            }
        }
        return $flattenArray;
    }
}
