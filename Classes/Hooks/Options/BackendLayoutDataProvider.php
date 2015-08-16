<?php
namespace BK2K\BootstrapPackage\Hooks\Options;

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

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\View\BackendLayout\BackendLayout;
use TYPO3\CMS\Backend\View\BackendLayout\BackendLayoutCollection;
use TYPO3\CMS\Backend\View\BackendLayout\DataProviderContext;
use TYPO3\CMS\Backend\View\BackendLayout\DataProviderInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This Provider adds Backend Layouts based on PageTsConfig
 *
 * = Example =
 * mod {
 *   web_layout {
 *     BackendLayouts {
 *       example {
 *         title = Example
 *         config {
 *           backend_layout {
 *             colCount = 1
 *             rowCount = 2
 *             rows {
 *               1 {
 *                 columns {
 *                   1 {
 *                     name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.border
 *                     colPos = 3
 *                     colspan = 1
 *                   }
 *                 }
 *               }
 *               2 {
 *                 columns {
 *                   1 {
 *                     name = Main
 *                     colPos = 0
 *                     colspan = 1
 *                   }
 *                 }
 *               }
 *             }
 *           }
 *         }
 *         icon = EXT:bootstrap_package/Resources/Public/Images/BackendLayouts/default.gif
 *       }
 *     }
 *   }
 * }
 *
 * @author Benjamin Kott <info@bk2k.info>
 */
class BackendLayoutDataProvider implements DataProviderInterface
{

    /**
     * Internal Backend Layout stack
     *
     * @var array
     */
    protected $backendLayouts = array();

    /**
     * PageTs Config
     *
     * @var array
     */
    protected $pageTsConfig = array();

    /**
     * PageId
     *
     * @var integer
     */
    protected $pageId = null;

    /**
     * Set PageTsConfig
     *
     * @param array $pageTsConfig
     * @return void
     */
    protected function setPageTsConfig($pageTsConfig)
    {
        $this->pageTsConfig = $pageTsConfig;
    }

    /**
     * Get PageTsConfig
     *
     * @return array
     */
    protected function getPageTsConfig()
    {
        return $this->pageTsConfig;
    }

    /**
     * Set PageId
     *
     * @param integer $pageId
     * @return void
     */
    protected function setPageId($pageId)
    {
        $this->pageId = (int)$pageId;
    }

    /**
     * Get PageId
     *
     * @return integer
     */
    protected function getPageId()
    {
        return $this->pageId;
    }

    /**
     * Gets PageTsConfig from DataProviderContext if available,
     * if not it will be generated for the current Page.
     *
     * @param DataProviderContext $dataProviderContext
     * @return void
     */
    protected function generatePageTsConfig($dataProviderContext = null)
    {
        if ($dataProviderContext === null) {
            $pageId = (int)($this->getPageId() !== null ?: GeneralUtility::_GP('id'));
            $this->setPageTsConfig((array)BackendUtility::getPagesTSconfig($pageId));
        } else {
            $this->setPageTsConfig((array)$dataProviderContext->getPageTsConfig());
        }
    }

    /**
     * Generate the Backend Layout configs
     *
     * @param DataProviderContext $dataProviderContext
     * @return void
     */
    protected function generateBackendLayouts($dataProviderContext = null)
    {
        $this->generatePageTsConfig($dataProviderContext);
        $pageTsConfig = $this->getPageTsConfig();
        if (!empty($pageTsConfig['mod.']['web_layout.']['BackendLayouts.'])) {
            $backendLayouts = (array)$pageTsConfig['mod.']['web_layout.']['BackendLayouts.'];
            foreach ($backendLayouts as $identifier => $data) {
                $backendLayout = $this->generateBackendLayoutFromTsConfig($identifier, $data);
                $this->attachBackendLayout($backendLayout);
            }
        }
    }

    /**
     * Generates a Backend Layout from PageTsConfig array
     *
     * @return mixed
     */
    protected function generateBackendLayoutFromTsConfig($identifier, $data)
    {
        if (!empty($data['config.']['backend_layout.']) && is_array($data['config.']['backend_layout.'])) {
            $backendLayout['uid'] = substr($identifier, 0, -1);
            $backendLayout['title'] = ($data['title']) ? $data['title'] : $backendLayout['uid'];
            $backendLayout['icon'] = ($data['icon']) ? $data['icon'] : '';
            /* Convert PHP array back to plain TypoScript so it can be procecced */
            $config = \TYPO3\CMS\Core\Utility\ArrayUtility::flatten($data['config.']);
            $backendLayout['config'] = '';
            foreach ($config as $row => $value) {
                $backendLayout['config'] .= $row . " = " . $value . "\r\n";
            }
            return $backendLayout;
        }
        return null;
    }

    /**
     * Attach Backend Layout to internal Stack
     *
     * @param mixed $backendLayout
     */
    protected function attachBackendLayout($backendLayout = null)
    {
        if ($backendLayout) {
            $this->backendLayouts[$backendLayout['uid']] = $backendLayout;
        }
    }

    /**
     * @param DataProviderContext $dataProviderContext
     * @param BackendLayoutCollection $backendLayoutCollection
     * @return void
     */
    public function addBackendLayouts(
        DataProviderContext $dataProviderContext,
        BackendLayoutCollection $backendLayoutCollection
    ) {
        $this->generateBackendLayouts($dataProviderContext);
        foreach ($this->backendLayouts as $backendLayoutConfig) {
            $backendLayout = $this->createBackendLayout($backendLayoutConfig);
            $backendLayoutCollection->add($backendLayout);
        }
    }

    /**
     * Gets a backend layout by (regular) identifier.
     *
     * @param string $identifier
     * @param integer $pageId
     * @return NULL|BackendLayout
     */
    public function getBackendLayout($identifier, $pageId)
    {
        $this->setPageId($pageId);
        $this->generateBackendLayouts();
        $backendLayout = null;
        if (array_key_exists($identifier, $this->backendLayouts)) {
            return $this->createBackendLayout($this->backendLayouts[$identifier]);
        }
        return $backendLayout;
    }

    /**
     * Creates a new backend layout using the given record data.
     *
     * @param array $data
     * @return BackendLayout
     */
    protected function createBackendLayout(array $data)
    {
        $backendLayout = BackendLayout::create($data['uid'], $data['title'], $data['config']);
        $backendLayout->setIconPath($this->getIconPath($data['icon']));
        $backendLayout->setData($data);
        return $backendLayout;
    }

    /**
     * Gets and sanitizes the icon path.
     *
     * @param string $icon Name of the icon file
     * @return string
     */
    protected function getIconPath($icon)
    {
        $iconPath = '';
        if (!empty($icon)) {
            $iconPath = $icon;
        }
        return $iconPath;
    }
}
