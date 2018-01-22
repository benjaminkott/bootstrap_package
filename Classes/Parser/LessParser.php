<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Parser;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\SignalSlot\Dispatcher;

/**
 * LessParser
 */
class LessParser extends AbstractParser
{
    /**
     * @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher
     */
    protected $signalSlotDispatcher;

    /**
     * Constructor
     */
    public function __construct()
    {
        if (!class_exists('Less_Cache', false)) {
            require_once(ExtensionManagementUtility::extPath('bootstrap_package') . '/Contrib/less.php/Less.php');
        }
    }

    /**
     * @param string $extension
     * @return bool
     */
    public function supports($extension)
    {
        return $extension === 'less';
    }

    /**
     * @param string $file
     * @param array $settings
     * @return string
     */
    public function compile($file, $settings)
    {
        // Initialize Arguments
        $arguments = [
            'file' => [
                'absolute' => $settings['file']['absolute'],
            ],
            'options' => [
                'compress' => true,
                'cache_dir' => GeneralUtility::getFileAbsFileName($settings['cache']['tempDirectory'])
            ],
            'variables' => $settings['variables'],
        ];
        if ($settings['options']['sourceMap']) {
            // Enable source mapping
            $optionsForSourceMap = [
                'sourceMap' => true,
                'sourceMapWriteTo' => GeneralUtility::getFileAbsFileName($settings['cache']['tempDirectory']) . basename($file) . '.map',
                'sourceMapURL' => '/' . $settings['cache']['tempDirectory'] . basename($file) . '.map',
                'sourceMapBasepath' => realpath(PATH_site),
                'sourceMapRootpath' => '/'
            ];
            $arguments['options'] += $optionsForSourceMap;
            // Disable CSS compression
            /** @var $pageRenderer \TYPO3\CMS\Core\Page\PageRenderer */
            $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
            $pageRenderer->disableCompressCss();
        }

        // Emit signal before less compiling to allow overriding of arguments
        $arguments = $this->emitBeforeLessCompilingSignal($arguments);

        // Process file
        $files = [];
        $files[$arguments['file']['absolute']] = $settings['cache']['tempDirectoryRelativeToRoot'] . str_replace(PATH_site, '', dirname($arguments['file']['absolute'])) . '/';
        $compiledFile = \Less_Cache::Get($files, $arguments['options'], $arguments['variables']);
        $file = $settings['cache']['tempDirectory'] . $compiledFile;

        return $file;
    }

    /**
     * @param array $arguments
     * @return array
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
