<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This service handles the parsing of less files for the frontend. You can extend
 * the compile service with a signal, that is triggered just before rendering.
 *
 * To fulfill that signal, you can create a slot in your custom extension.
 * All what it needs is an entry in your ext_localconf.php file:
 *
 * $signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\SignalSlot\\Dispatcher');
 * $signalSlotDispatcher->connect(
 *   'BK2K\\BootstrapPackage\\Service\\CompileService',
 *   'beforeLessCompiling',
 *   'YourVendor\\YourExtension\\Slots\\CompileServiceSlot',
 *   'beforeLessCompiling'
 * );
 *
 * Example call:
 *
 * $file -> array
 * $options -> array
 * $variables -> array
 *
 * public function beforeLessCompiling($file, $options, $variables)
 * {
 *   return [
 *     'file' => $file,
 *     'options' => $options,
 *     'variables' => $variables,
 *   ];
 * }
 */
class CompileService
{
    /**
     * @var string
     */
    protected $tempDirectory = 'typo3temp/assets/bootstrappackage/';

    /**
     * @var string
     */
    protected $tempDirectoryRelativeToRoot = '../../../';

    /**
     * @param string $file
     * @return bool|string
     * @throws \Exception
     */
    public function getCompiledFile($file)
    {
        $absoluteFile = GeneralUtility::getFileAbsFileName($file);
        $configuration = ($GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_bootstrappackage.']['settings.'] ?: []);

        // Ensure cache directory exists
        if (!file_exists($this->tempDirectory)) {
            GeneralUtility::mkdir_deep($this->tempDirectory);
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
                'override' => ($configuration['overrideParserVariables'] ? true: false),
                'sourceMap' => ($configuration['cssSourceMapping'] ? true : false),
                'compress' => true
            ],
            'variables' => []
        ];

        // Parser
        if (!empty($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/bootstrap-package/css']['parser'])) {
            foreach ($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/bootstrap-package/css']['parser'] as $className) {
                $parser = GeneralUtility::makeInstance($className);
                if ($parser->supports($settings['file']['info']['extension'])) {
                    if ($configuration['overrideParserVariables']) {
                        $settings['variables'] = $this->getVariablesFromConstants($settings['file']['info']['extension']);
                    }
                    try {
                        $compiledFile = $parser->compile($file, $settings);
                        return $compiledFile;
                    } catch (\Exception $e) {
                        throw new \Exception($e->getMessage());
                    }
                }
            }
        }

        return false;
    }

    /**
     * @param string $extension
     * @return array
     */
    public function getVariablesFromConstants($extension)
    {
        $extension = strtolower($extension);
        $variables = [];
        $prefix = 'plugin.bootstrap_package.settings.' . $extension . '.';
        if (!isset($GLOBALS['TSFE']->tmpl->flatSetup)
            || !is_array($GLOBALS['TSFE']->tmpl->flatSetup)
            || count($GLOBALS['TSFE']->tmpl->flatSetup) === 0) {
            $GLOBALS['TSFE']->tmpl->generateConfig();
        }
        foreach ($GLOBALS['TSFE']->tmpl->flatSetup as $constant => $value) {
            if (strpos($constant, $prefix) === 0) {
                $variables[substr($constant, strlen($prefix))] = $value;
            }
        }
        return $variables;
    }
}
