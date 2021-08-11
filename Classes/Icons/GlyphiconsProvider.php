<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Icons;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * GlyphiconsProvider
 */
class GlyphiconsProvider implements IconProviderInterface
{
    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return 'EXT:bootstrap_package/Resources/Public/Images/Icons/Glyphicons/';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Glyphicons';
    }

    /**
     * @param string $identifier
     * @return bool
     */
    public function supports(string $identifier): bool
    {
        return 'EXT:bootstrap_package/Resources/Public/Images/Icons/Glyphicons/' === $identifier;
    }

    /**
     * @return IconList
     */
    public function getIconList(): IconList
    {
        $icons = new IconList();

        $directory = 'EXT:bootstrap_package/Resources/Public/Images/Icons/Glyphicons/';
        $path = GeneralUtility::getFileAbsFileName($directory);
        $files = iterator_to_array(new \FilesystemIterator($path, \FilesystemIterator::KEY_AS_PATHNAME));
        ksort($files);

        foreach ($files as $key => $fileinfo) {
            if ($fileinfo instanceof \SplFileInfo
                && $fileinfo->isFile()
                && strtolower($fileinfo->getExtension()) === 'svg'
            ) {
                $icons->addIcon(
                    (new SvgIcon())
                        ->setSrc($directory . $fileinfo->getFilename())
                        ->setIdentifier($directory . $fileinfo->getFilename())
                        ->setName($fileinfo->getBasename('.' . $fileinfo->getExtension()))
                        ->setPreviewImage($directory . $fileinfo->getFilename())
                );
            }
        }

        return $icons;
    }
}
