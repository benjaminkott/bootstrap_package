<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Userfuncs;

use TYPO3\CMS\Backend\Utility\BackendUtility;

class Tca
{
    public function timelineItemLabel(&$parameters)
    {
        $record = BackendUtility::getRecord($parameters['table'], $parameters['row']['uid']);
        $parameters['title'] = $record['date'] . ' - ' . $record['header'];
    }
}
