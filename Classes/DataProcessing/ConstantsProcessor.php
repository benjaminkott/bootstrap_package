<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\DataProcessing;

use BK2K\BootstrapPackage\Utility\TypoScriptUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * Minimal TypoScript configuration
 * Assign all available typoscript constants for a key to template view, the
 * default key that is used is `page` and the default variable is `constants`.
 *
 * 10 = BK2K\BootstrapPackage\DataProcessing\ConstantsProcessor
 *
 *
 * Advanced TypoScript configuration
 *
 * 10 = BK2K\BootstrapPackage\DataProcessing\ConstantsProcessor
 * 10 {
 *   key = page
 *   as = constants
 * }
 */
class ConstantsProcessor implements DataProcessorInterface
{
    /**
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData)
    {
        // The key to process
        $key = (string) $cObj->stdWrapValue('key', $processorConfiguration);
        if ($key === '') {
            $key = 'page';
        }

        $constants = TypoScriptUtility::getConstantsByPrefix($cObj->getRequest(), $key);
        $constants = TypoScriptUtility::unflatten($constants);

        // Set the target variable
        $targetVariableName = (string) $cObj->stdWrapValue('as', $processorConfiguration);
        if ($targetVariableName !== '') {
            $processedData[$targetVariableName] = $constants;
        } else {
            $processedData['constants'] = $constants;
        }

        return $processedData;
    }
}
