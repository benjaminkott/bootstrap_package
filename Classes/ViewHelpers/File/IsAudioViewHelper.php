<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers\File;

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class IsAudioViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return mixed
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $file = $renderChildrenClosure();
        $allowedFileExtensions = $GLOBALS['TYPO3_CONF_VARS']['SYS']['audiofile_ext'] ?? '';
        $allowedFileExtensions = GeneralUtility::trimExplode(',', $allowedFileExtensions);

        if (is_object($file)
            && ($file instanceof FileReference || $file instanceof File)
            && (
                in_array($file->getExtension(), $allowedFileExtensions, true)
                || $file->getType() === File::FILETYPE_AUDIO
            )
        ) {
            return true;
        }

        return false;
    }
}
