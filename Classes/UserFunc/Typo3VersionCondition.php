<?php
namespace BK2K\BootstrapPackage\UserFunc;

/*
 *  The MIT License (MIT)
 *
 *  Copyright (c) 2014 Benjamin Kott, http://www.bk2k.info
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in
 *  all copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *  THE SOFTWARE.
 */

use TYPO3\CMS\Core\Utility\VersionNumberUtility;

/**
 * This TypoScript condition compares an integer to the current TYPO3 version
 *
 * = Example =
 * [userFunc = \BK2K\BootstrapPackage\UserFunc\Typo3VersionCondition::match(lessThan, 7000000)]
 *   page.6 = TEXT
 *   page.6.value = LOWER CMS 7
 *   page.6.wrap = <div>|</div>
 * [global]
 *
 * @author Benjamin Kott <info@bk2k.info>
 */
class Typo3VersionCondition
{

    /**
     * @param string $operator
     * @param integer $value
     * @return bool
     */
    public function match($operator = null, $value = null)
    {
        $result = false;
        $value = intval($value);
        $version = VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version);
        if ($value) {
            if ($operator === "equals" && $version === $value) {
                $result = true;
            } elseif ($operator === "lessThan" && $version < $value) {
                $result = true;
            } elseif ($operator === "greaterThan" && $version > $value) {
                $result = true;
            }
        }
        return $result;
    }
}
