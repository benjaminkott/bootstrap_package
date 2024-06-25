<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\SiteCreator\Hooks;

use TYPO3\CMS\Core\DataHandling\DataHandler;

/**
 * SiteCreatorHook
 */
class SiteCreatorHook
{
    /**
     * @param array $incomingFieldArray
     * @param string $table
     * @param string $id
     * @param DataHandler $dataHandler
     */
    public function processDatamap_preProcessFieldArray(&$incomingFieldArray, $table, $id, $dataHandler): void
    {
        foreach ($incomingFieldArray as $parameter => $parameterValue) {
            if (!in_array($parameter, ['uid', 'pid'])) {
                if (!isset($GLOBALS['TCA'][$table]['columns'][$parameter])) {
                    continue;
                }
                $fieldConfig = $GLOBALS['TCA'][$table]['columns'][$parameter]['config'];
                switch ($fieldConfig['type']) {
                    case 'text':
                    case 'input':
                    case 'inline':
                    case 'select':
                    case 'group':
                        $incomingFieldArray[$parameter] = str_replace(
                            array_keys($dataHandler->substNEWwithIDs),
                            array_values($dataHandler->substNEWwithIDs),
                            (string) $incomingFieldArray[$parameter]
                        );
                        break;
                }
            }
        }
    }
}
