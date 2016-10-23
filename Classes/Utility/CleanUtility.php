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
class CleanUtility
{
    /**
    * Tab character
    *
    * @var string
    */
    protected static $tab = "\t";

    /**
    * Newline character
    *
    * @var string
    */
    protected static $newline = "\n";

    /**
    * Clean up white space and empty lines
    *
    * @param string $html
    * @param bool $trim start of lines
    *
    * @return string
    */
    public static function optimize($html, $trim = false)
    {
        switch (TYPO3_OS) { // set newline
            case 'WIN':
                self::$newline = "\r\n";
                break;
            default:
                self::$newline = "\n";
        }

        // newlines
        $html = preg_replace("(\r\n|\n|\r)", self::$newline, $html);
        // remove empty lines
        $html = preg_replace('/(^[' . self::$newline . ']*|[' . self::$newline . "]+)[\s\t]*[" . self::$newline . ']+/', self::$newline, $html);
        // replace tabs by spaces
        $html = str_replace(self::$tab, ' ', $html);
        // remove double spaces
        $html = preg_replace("/\s\s+/u", ' ', $html);
        // trim
        if ($trim) {
            $html = preg_replace("/^[\s]+/", '', $html);
        }
        return $html;
    }
}
