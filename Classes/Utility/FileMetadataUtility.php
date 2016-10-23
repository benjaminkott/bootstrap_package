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


/**
* @author Benjamin Kott <info@bk2k.info>
*/
class FileMetadataUtility
{
    /**
    * @param \TYPO3\CMS\Core\Resource\FileReference $file
    * @return boolean
    */
    public static function hasDimension(\TYPO3\CMS\Core\Resource\FileReference $file)
    {
        return $file->getProperty('width') and $file->getProperty('height');
    }

    /**
    * @param \TYPO3\CMS\Core\Resource\FileReference $file
    * @return array
    */
    public static function getDimension(\TYPO3\CMS\Core\Resource\FileReference $file)
    {
        $crop = $file->getProperty('crop');
        if ($crop != '') {
            $crop = json_decode($crop);
            return array (
                'width' => $crop->width,
                'height' => $crop->height
            );
        }
        $width = $file->getProperty('width');
        $height = $file->getProperty('height');
        if ($width and $height) {
            return array (
                'width' => $width,
                'height' => $height
            );
        }
        return array(800, 450);
    }
    /**
    * @param \TYPO3\CMS\Core\Resource\FileReference $file
    * @return float $ratio ratio h/w
    */
    public static function getRatio(\TYPO3\CMS\Core\Resource\FileReference $file)
    {
        $size = self::getDimension($file);
        if ($size['height'] != 0 and $size['width'] != 0) {
            return $size['height'] / $size['width'];
        }
        return 1000;
    }
}
