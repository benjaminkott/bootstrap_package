<?php
namespace BK2K\BootstrapPackage\UserFunc;

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
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Extbase\Utility\ArrayUtility;

/**
 * @author Till Busch <till@bux.at>
 */
class TemplateFileResolver
{

    /**
     * @param string $content
     * @param array $conf
     * @return string
     */
    public function getTemplateFromName($content, $conf)
    {
        $basename = $content;

        if ($conf['paths'][0] === '<') {
            $key = trim(substr($conf['paths'], 1));
            $typoScriptParser = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\TypoScript\\Parser\\TypoScriptParser');
            list($name, $conf['paths.']) = $typoScriptParser->getVal($key, $GLOBALS['TSFE']->tmpl->setup);
        }

        $paths = ArrayUtility::sortArrayWithIntegerKeys($conf['paths.']);
        $paths = array_reverse($paths, true);

        foreach ($paths as $path) {
            // why does it have to be relative?
            $test_file = PathUtility::getRelativePathTo(GeneralUtility::getFileAbsFileName($path)) . $basename;
            if (is_file($test_file)) {
                return $test_file;
            }
            if (is_file($test_file . '.html')) {
                return $test_file . '.html';
            }
        }
        return $content;
    }
}
