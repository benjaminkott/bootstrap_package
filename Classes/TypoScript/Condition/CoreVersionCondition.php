<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\TypoScript\Condition;

use TYPO3\CMS\Core\Configuration\TypoScript\ConditionMatching\AbstractCondition;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;

/**
 * This TypoScript condition compares an integer to the current TYPO3 version
 *
 * = Example =
 * [BK2K\BootstrapPackage\TypoScript\Condition\CoreVersionCondition < 9.3]
 *   page.6 = TEXT
 *   page.6.value = TYPO3 CORE VERSION IS LOWER THAN 9.3
 *   page.6.wrap = <div>|</div>
 * [global]
 *
 */
class CoreVersionCondition extends AbstractCondition
{
    /**
     * Evaluate condition
     *
     * @param array $conditionParameters
     * @return bool
     */
    public function matchCondition(array $conditionParameters)
    {
        if (empty($conditionParameters)) {
            return false;
        }

        $coreVersion = VersionNumberUtility::getNumericTypo3Version();
        $coreVersionInteger = VersionNumberUtility::convertVersionNumberToInteger($coreVersion);
        foreach ($conditionParameters as $expression) {
            if (\TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($expression)) {
                $expression = '=' . $expression;
            }
            if ($this->compareNumber($expression, $coreVersionInteger)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Evaluates a $leftValue based on an operator: "<", ">", "<=", ">=", "!=" or "="
     *
     * @param string $test The value to compare with on the form [operator][number]. Eg. "< 123
     * @param float $leftValue The value on the left side
     * @return bool If $value is "50" and $test is "< 123" then it will return TRUE.
     */
    protected function compareNumber($test, $leftValue)
    {
        if (preg_match('/^(!?=+|<=?|>=?)\\s*([^\\s]*)\\s*$/', $test, $matches)) {
            $operator = $matches[1];
            $rightValue = $matches[2];
            switch ($operator) {
                case '>=':
                    return $leftValue >= VersionNumberUtility::convertVersionNumberToInteger($rightValue);
                case '<=':
                    return $leftValue <= VersionNumberUtility::convertVersionNumberToInteger($rightValue);
                case '!=':
                    // multiple values may be split with '|'
                    // see if none matches ("not in list")
                    $found = false;
                    $rightValueParts = GeneralUtility::trimExplode('|', $rightValue);
                    foreach ($rightValueParts as $rightValueSingle) {
                        if ($leftValue == VersionNumberUtility::convertVersionNumberToInteger($rightValueSingle)) {
                            $found = true;
                            break;
                        }
                    }
                    return $found === false;
                case '<':
                    return $leftValue < VersionNumberUtility::convertVersionNumberToInteger($rightValue);
                case '>':
                    return $leftValue > VersionNumberUtility::convertVersionNumberToInteger($rightValue);
                default:
                    // nothing valid found except '=', use '='
                    // multiple values may be split with '|'
                    // see if one matches ("in list")
                    $found = false;
                    $rightValueParts = GeneralUtility::trimExplode('|', $rightValue);
                    foreach ($rightValueParts as $rightValueSingle) {
                        if ($leftValue == VersionNumberUtility::convertVersionNumberToInteger($rightValueSingle)) {
                            $found = true;
                            break;
                        }
                    }
                    return $found;
            }
        }
        return false;
    }
}
