<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Service;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\SignalSlot\Dispatcher;

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
     * @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher
     */
    protected $signalSlotDispatcher;

    /**
     * @param string $file
     * @return bool|string
     * @throws \Exception
     */
    public function getCompiledFile($file)
    {
        $file = GeneralUtility::getFileAbsFileName($file);
        $pathParts = pathinfo($file);
        if ($pathParts['extension'] === 'less') {
            try {
                // Initialize Arguments
                $arguments = [
                    'file' => [
                        'absolute' => $file,
                    ],
                    'options' => [
                        'compress' => true,
                        'cache_dir' => GeneralUtility::getFileAbsFileName($this->tempDirectory)
                    ],
                    'variables' => [],
                ];
                $settings = ($GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_bootstrappackage.']['settings.'] ?: []);
                if ($settings['cssSourceMapping']) {
                    // Enable source mapping
                    $optionsForSourceMap = [
                        'sourceMap' => true,
                        'sourceMapWriteTo' => GeneralUtility::getFileAbsFileName($this->tempDirectory) . basename($file) . '.map',
                        'sourceMapURL' => '/' . $this->tempDirectory . basename($file) . '.map',
                        'sourceMapBasepath' => realpath(PATH_site),
                        'sourceMapRootpath' => '/'
                    ];
                    $arguments['options'] += $optionsForSourceMap;
                    // Disable CSS compression
                    /** @var $pageRenderer \TYPO3\CMS\Core\Page\PageRenderer */
                    $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
                    $pageRenderer->disableCompressCss();
                }
                // Get variables from constants to override less variables
                if ($settings['overrideLessVariables']) {
                    $arguments['variables'] = $this->getVariablesFromConstants();
                }
                // Emit signal before less compiling to allow overriding of arguments
                $arguments = $this->emitBeforeLessCompilingSignal($arguments);
                // Process file
                $files = [];
                $files[$arguments['file']['absolute']] = $this->tempDirectoryRelativeToRoot . str_replace(PATH_site, '', dirname($arguments['file']['absolute'])) . '/';
                $compiledFile = \Less_Cache::Get($files, $arguments['options'], $arguments['variables']);
                $file = $this->tempDirectory . $compiledFile;

                return $file;
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
        return false;
    }

    /**
     * @return array
     */
    public function getVariablesFromConstants()
    {
        $variables = [];
        $prefix = 'plugin.bootstrap_package.settings.less.';
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

    /**
     * @param array $arguments
     */
    protected function emitBeforeLessCompilingSignal($arguments)
    {
        return $this->getSignalSlotDispatcher()->dispatch(
            __CLASS__,
            'beforeLessCompiling',
            $arguments
        );
    }

    /**
     * Get the SignalSlot dispatcher
     *
     * @return Dispatcher
     */
    protected function getSignalSlotDispatcher()
    {
        if (!isset($this->signalSlotDispatcher)) {
            $this->signalSlotDispatcher = GeneralUtility::makeInstance(ObjectManager::class)
                ->get(Dispatcher::class);
        }
        return $this->signalSlotDispatcher;
    }
}
