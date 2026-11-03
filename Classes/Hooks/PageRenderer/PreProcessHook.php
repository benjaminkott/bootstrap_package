<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Hooks\PageRenderer;

use BK2K\BootstrapPackage\Service\CompileService;
use BK2K\BootstrapPackage\Utility\TypoScriptUtility;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Http\ApplicationType;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * PreProcessHook
 */
class PreProcessHook
{
    /**
     * @var \BK2K\BootstrapPackage\Service\CompileService
     */
    protected $compileService;

    /**
     * @param array $params
     * @param \TYPO3\CMS\Core\Page\PageRenderer $pagerenderer
     */
    public function execute(&$params, &$pagerenderer): void
    {
        if (!($GLOBALS['TYPO3_REQUEST'] ?? null) instanceof ServerRequestInterface ||
            !ApplicationType::fromRequest($GLOBALS['TYPO3_REQUEST'])->isFrontend()) {
            return;
        }

        $sourceMap = (bool) (TypoScriptUtility::getSetup($GLOBALS['TYPO3_REQUEST'])['plugin.']['tx_bootstrappackage.']['settings.']['cssSourceMapping'] ?? false);

        foreach (['cssLibs', 'cssFiles'] as $key) {
            $files = [];
            if (is_array($params[$key])) {
                foreach ($params[$key] as $file => $settings) {
                    $compiledFile = $this->getCompileService()->getCompiledFile($GLOBALS['TYPO3_REQUEST'], $file);
                    if ($compiledFile !== null) {
                        $settings['file'] = $compiledFile;
                        if ($sourceMap) {
                            // TYPO3 v13 would compress and concatenate the CSS away from its source map
                            $settings['compress'] = false;
                            $settings['excludeFromConcatenation'] = true;
                        }
                        $files[$compiledFile] = $settings;
                    } else {
                        $files[$file] = $settings;
                    }
                }
                $params[$key] = $files;
            }
        }
    }

    /**
     * Get the compile service
     *
     * @return CompileService
     */
    protected function getCompileService(): CompileService
    {
        if ($this->compileService === null) {
            $this->compileService = GeneralUtility::makeInstance(CompileService::class);
        }
        return $this->compileService;
    }
}
