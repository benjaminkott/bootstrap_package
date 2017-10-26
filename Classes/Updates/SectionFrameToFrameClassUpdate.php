<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Updates;

/**
 * SectionFrameToFrameClassUpdate
 */
class SectionFrameToFrameClassUpdate extends \TYPO3\CMS\Install\Updates\SectionFrameToFrameClassUpdate
{
    /**
     * Map the old to the new values
     *
     * @param int $sectionFrame The content of the FlexForm
     * @return string The equivalent value frame_class
     */
    protected function mapSectionFrame($sectionFrame)
    {
        $mapping = [
            0 => 'default',
            5 => 'ruler-before',
            6 => 'ruler-after',
            10 => 'indent',
            11 => 'indent-left',
            12 => 'indent-right',
            20 => 'well',
            21 => 'jumbotron',
            66 => 'none'
        ];
        if (array_key_exists($sectionFrame, $mapping)) {
            return $mapping[$sectionFrame];
        }
        return 'custom-' . (int) $sectionFrame;
    }
}
