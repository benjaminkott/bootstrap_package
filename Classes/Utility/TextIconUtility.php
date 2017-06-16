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
        if (is_array($parameters['TSconfig']) && isset($parameters['TSconfig']['directory'])) {
            $directory = $parameters['TSconfig']['directory'];
        } else {
            $directory = 'EXT:bootstrap_package/Resources/Public/Images/Icons/Glyphicons/';
        }
        $icons = self::getIcons($directory);
        if ($icons) {
            $parameters['items'] = array_merge($parameters['items'], $icons);
        }
    }

    /**
     * @param string $directory
     * @return array|bool
     */
    public function getIcons($directory)
    {
        $icons = [];
        if (strpos($directory, 'EXT:') !== 0 || !strpos($directory, 'Resources/Public')) {
            return false;
        }
        $path = GeneralUtility::getFileAbsFileName($directory);
        if (!is_dir($path)) {
            return false;
        }
        $identifier = pathinfo($path)['basename'];
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
                $iconPath = str_replace('\\', '/', $iconPath);
                $icons[] = [
                    $pathinfo['filename'],
                    $identifier . '__' . $pathinfo['filename'],
                    $iconPath
                ];
            }
        }

        return $icons;
    }
}
