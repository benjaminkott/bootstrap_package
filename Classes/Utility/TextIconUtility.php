<?php
namespace BK2K\BootstrapPackage\Utility;

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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * @author Benjamin Kott <info@bk2k.info>
 */
class TextIconUtility
{
    /**
     * @param array $parameters
     */
    public function addIconItems(array $parameters)
    {
        $icons = self::getIcons('EXT:bootstrap_package/Resources/Public/Images/Icons/Glyphicons/');
        $parameters['items'] = array_merge($parameters['items'], $icons);
    }

    /**
     * @param string $directory
     * @return array
     */
    public function getIcons($directory)
    {
        $icons = [];
        if (strpos($directory, 'EXT:') === 0) {
            $path = GeneralUtility::getFileAbsFileName($directory);
            $files = iterator_to_array(
                new \FilesystemIterator(
                    $path,
                    \FilesystemIterator::KEY_AS_PATHNAME
                )
            );
            ksort($files);
            foreach ($files as $key => $fileinfo) {
                if ($fileinfo->isFile() && in_array($fileinfo->getExtension(), ['svg', 'png', 'jpg', 'gif'])) {
                    $pathinfo = pathinfo($fileinfo->getPathname());
                    $iconPath = str_replace(PATH_site . 'typo3conf/ext/', 'EXT:', $fileinfo->getPathname());
                    $icons[] = [
                        $pathinfo['filename'],
                        $pathinfo['filename'],
                        $iconPath
                    ];
                }
            }
        }
        return $icons;
    }
}
