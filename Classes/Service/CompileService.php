<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Service;

use BK2K\BootstrapPackage\Parser\ParserInterface;
use BK2K\BootstrapPackage\Utility\TypoScriptUtility;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This service handles the parsing of css files for the frontend.
 */
class CompileService
{
    /**
     * @var string
     */
    protected $tempDirectory = 'typo3temp/assets/bootstrappackage/css/';

    /**
     * @var string
     */
    protected $tempDirectoryRelativeToRoot = '../../../../';

    /**
     * @param string $file
     * @return string|null
     * @throws \Exception
     */
    public function getCompiledFile(ServerRequestInterface $request, string $file): ?string
    {
        $absoluteFile = GeneralUtility::getFileAbsFileName($file);
        $configuration = TypoScriptUtility::getSetup($request)['plugin.']['tx_bootstrappackage.']['settings.'] ?? [];

        // Ensure cache directory exists
        if (!file_exists(Environment::getPublicPath() . '/' . $this->tempDirectory)) {
            GeneralUtility::mkdir_deep(Environment::getPublicPath() . '/' . $this->tempDirectory);
        }

        // Settings
        $settings = [
            'file' => [
                'absolute' => $absoluteFile,
                'relative' => $file,
                'info' => pathinfo($absoluteFile)
            ],
            'cache' => [
                'tempDirectory' => $this->tempDirectory,
                'tempDirectoryRelativeToRoot' => $this->tempDirectoryRelativeToRoot,
            ],
            'options' => [
                'override' => (bool) ($configuration['overrideParserVariables'] ?? false),
                'sourceMap' => (bool) ($configuration['cssSourceMapping'] ?? false),
                'compress' => true
            ],
            'variables' => []
        ];

        // Parser
        if (isset($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/bootstrap-package/css']['parser'])
            && is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/bootstrap-package/css']['parser'])
        ) {
            foreach ($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/bootstrap-package/css']['parser'] as $className) {
                /** @var class-string<ParserInterface> $className */
                $parser = GeneralUtility::makeInstance($className);
                if ($parser instanceof ParserInterface
                    && isset($settings['file']['info']['extension'])
                    && $parser->supports($settings['file']['info']['extension'])
                ) {
                    if ((bool) ($configuration['overrideParserVariables'] ?? false)) {
                        $settings['variables'] = $this->getVariablesFromConstants($request, $settings['file']['info']['extension']);
                    }
                    try {
                        return $parser->compile($file, $settings);
                    } catch (\Exception $e) {
                        $this->clearCompilerCaches();
                        throw $e;
                    }
                }
            }
        }

        return null;
    }

    /**
     * @param string $extension
     * @return array
     */
    protected function getVariablesFromConstants(ServerRequestInterface $request, string $extension): array
    {
        $constants = TypoScriptUtility::getConstants($request);
        $extension = strtolower($extension);
        $variables = [];

        // Fetch Google Font
        $variables['google-webfont'] = 'sans-serif';
        if (isset($constants['page.theme.googleFont.enable'])
            && (bool) $constants['page.theme.googleFont.enable']
            && isset($constants['page.theme.googleFont.font'])
            && $constants['page.theme.googleFont.font'] !== ''
        ) {
            $variables['google-webfont'] = $constants['page.theme.googleFont.font'];
        }

        // Fetch settings
        $prefix = 'plugin.bootstrap_package.settings.' . $extension . '.';
        foreach ($constants as $constant => $value) {
            if (strpos($constant, $prefix) === 0) {
                $variables[substr($constant, strlen($prefix))] = $value;
            }
        }

        return $variables;
    }

    /**
     * Clear all caches for the compiler.
     */
    protected function clearCompilerCaches(): void
    {
        GeneralUtility::rmdir(Environment::getPublicPath() . '/' . $this->tempDirectory, true);
    }
}
