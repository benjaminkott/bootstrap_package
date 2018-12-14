<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Hooks\PageRendererRender;

use BK2K\BootstrapPackage\Service\CompileService;

/**
 * PreProcessHook
 */
class PreProcessHook
{

    /**
     * @param array $params
     * @param \TYPO3\CMS\Core\Page\PageRenderer $pagerenderer
     */
    public function execute(&$params, &$pagerenderer)
    {
        if (TYPO3_MODE !== 'FE' || !is_array($params['cssFiles'])) {
            return;
        }
        $files = [];
        foreach ($params['cssFiles'] as $file => $settings) {
            $compiledFile = CompileService::getCompiledFile($file);
            if ($compiledFile !== false) {
                $settings['file'] = $compiledFile;
                $files[$compiledFile] = $settings;
            } else {
                $files[$file] = $settings;
            }
        }
        $params['cssFiles'] = $files;
    }
}
