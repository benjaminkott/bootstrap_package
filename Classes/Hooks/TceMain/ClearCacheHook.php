<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Hooks\TceMain;

use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * ClearCacheHook
 */
class ClearCacheHook
{
    /**
     * @param array $params
     * @param \TYPO3\CMS\Core\DataHandling\DataHandler $pObj
     */
    public function clearLessCache(array $params, DataHandler &$pObj)
    {
        if (!isset($params['cacheCmd'])) {
            return;
        }
        switch ($params['cacheCmd']) {
            case 'all':
                GeneralUtility::rmdir(
                    PATH_site . 'typo3temp/assets/bootstrappackage',
                    true
                );
                break;
            default:
        }
    }
}
