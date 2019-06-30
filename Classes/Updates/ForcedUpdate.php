<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Updates;

use TYPO3\CMS\Core\Registry;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Forces inherited classes to be executed on every update request and ignores
 * the registry state therefor.
 */
class ForcedUpdate extends ForcedUpdate
{
    /**
     * Constructor
     */
    public function __construct()
    {
        GeneralUtility::makeInstance(Registry::class)->set('installUpdate', get_class($this), false);
    }
}
