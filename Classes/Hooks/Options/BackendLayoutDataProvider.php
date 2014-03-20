<?php
namespace BK2K\BootstrapPackage\Hooks\Options;

/***************************************************************
 * 
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
 *
 ***************************************************************/

use \TYPO3\CMS\Backend\View\BackendLayout\BackendLayout;
use \TYPO3\CMS\Backend\View\BackendLayout\DataProviderContext;
use \TYPO3\CMS\Backend\View\BackendLayout\BackendLayoutCollection;
use \TYPO3\CMS\Backend\Utility\BackendUtility;

/**
 * @author Benjamin Kott <info@bk2k.info>
 */
class BackendLayoutDataProvider implements \TYPO3\CMS\Backend\View\BackendLayout\DataProviderInterface {

    /**
     * Default Backend Layouts for Bootstrap Theme
     * 
     * @var array
     */
    protected $backendLayouts = array(
        'default' => array(
            'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.default',
            'config' => '
                backend_layout {
                    colCount = 6
                    rowCount = 3
                    rows {
                        1 {
                            columns {
                                1 {
                                    name = LLL:EXT:cms/locallang_ttc.xlf:colPos.I.3
                                    colPos = 3
                                    colspan = 6
                                }
                            }
                        }
                        2 {
                            columns {
                                1 {
                                    name = LLL:EXT:cms/locallang_ttc.xlf:colPos.I.1
                                    colPos = 0
                                    colspan = 6
                                }
                            }
                        }
                        3 {
                            columns {
                                1 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer1
                                    colPos = 10
                                    colspan = 2
                                }
                                2 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer2
                                    colPos = 11
                                    colspan = 2
                                }
                                3 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer3
                                    colPos = 12
                                    colspan = 2
                                }
                            }
                        }
                    }
                }
            ',
            'icon' => 'EXT:bootstrap_package/Resources/Public/Images/BackendLayouts/default.gif'
        ),
        'default_2_columns' => array(
            'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.default_2_columns',
            'config' => '
                backend_layout {
                    colCount = 6
                    rowCount = 2
                    rows {
                        1 {
                            columns {
                                1 {
                                    name = LLL:EXT:cms/locallang_ttc.xlf:colPos.I.1
                                    colPos = 0
                                    colspan = 4
                                }
                                2 {
                                    name = LLL:EXT:cms/locallang_ttc.xlf:colPos.I.2
                                    colPos = 2
                                    colspan = 2
                                }
                            }
                        }
                        2 {
                            columns {
                                1 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer1
                                    colPos = 10
                                    colspan = 2
                                }
                                2 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer2
                                    colPos = 11
                                    colspan = 2
                                }
                                3 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer3
                                    colPos = 12
                                    colspan = 2
                                }
                            }
                        }
                    }
                }
            ',
            'icon' => 'EXT:bootstrap_package/Resources/Public/Images/BackendLayouts/default_2_columns.gif'
        ),
        'default_2_columns_offset_right' => array(
            'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.default_2_columns_offset_right',
            'config' => '
                backend_layout {
                    colCount = 6
                    rowCount = 2
                    rows {
                        1 {
                            columns {
                                1 {
                                    name = LLL:EXT:cms/locallang_ttc.xlf:colPos.I.1
                                    colPos = 0
                                    colspan = 4
                                }
                                2 {
                                    name = LLL:EXT:cms/locallang_ttc.xlf:colPos.I.2
                                    colPos = 2
                                    colspan = 2
                                }
                            }
                        }
                        2 {
                            columns {
                                1 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer1
                                    colPos = 10
                                    colspan = 2
                                }
                                2 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer2
                                    colPos = 11
                                    colspan = 2
                                }
                                3 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer3
                                    colPos = 12
                                    colspan = 2
                                }
                            }
                        }
                    }
                }
            ',
            'icon' => 'EXT:bootstrap_package/Resources/Public/Images/BackendLayouts/default_2_columns_offset_right.gif'
        ),
        'default_3_columns' => array(
            'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.default_3_columns',
            'config' => '
                backend_layout {
                    colCount = 6
                    rowCount = 2
                    rows {
                        1 {
                            columns {
                                1 {
                                    name = LLL:EXT:cms/locallang_ttc.xlf:colPos.I.0
                                    colPos = 1
                                    colspan = 1
                                }
                                2 {
                                    name = LLL:EXT:cms/locallang_ttc.xlf:colPos.I.1
                                    colPos = 0
                                    colspan = 4
                                }
                                3 {
                                    name = LLL:EXT:cms/locallang_ttc.xlf:colPos.I.2
                                    colPos = 2
                                    colspan = 1
                                }
                            }
                        }
                        2 {
                            columns {
                                1 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer1
                                    colPos = 10
                                    colspan = 2
                                }
                                2 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer2
                                    colPos = 11
                                    colspan = 2
                                }
                                3 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer3
                                    colPos = 12
                                    colspan = 2
                                }
                            }
                        }
                    }
                }
            ',
            'icon' => 'EXT:bootstrap_package/Resources/Public/Images/BackendLayouts/default_3_columns.gif'
        ),
        'default_subnavigation' => array(
            'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.default_subnavigation',
            'config' => '
                backend_layout {
                    colCount = 6
                    rowCount = 2
                    rows {
                        1 {
                            columns {
                                1 {
                                    name = LLL:EXT:cms/locallang_ttc.xlf:colPos.I.1
                                    colPos = 0
                                    colspan = 5
                                }
                                2 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.subnav
                                    colspan = 1
                                }
                            }
                        }
                        2 {
                            columns {
                                1 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer1
                                    colPos = 10
                                    colspan = 2
                                }
                                2 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer2
                                    colPos = 11
                                    colspan = 2
                                }
                                3 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer3
                                    colPos = 12
                                    colspan = 2
                                }
                            }
                        }
                    }
                }
            ',
            'icon' => 'EXT:bootstrap_package/Resources/Public/Images/BackendLayouts/default_subnavigation.gif'
        ),
        'default_subnavigation_2_columns' => array(
            'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.default_subnavigation_2_columns',
            'config' => '
                backend_layout {
                    colCount = 6
                    rowCount = 2
                    rows {
                        1 {
                            columns {
                                1 {
                                    name = LLL:EXT:cms/locallang_ttc.xlf:colPos.I.1
                                    colPos = 0
                                    colspan = 4
                                }
                                2 {
                                    name = LLL:EXT:cms/locallang_ttc.xlf:colPos.I.2
                                    colPos = 2
                                    colspan = 1
                                }
                                3 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.subnav
                                    colspan = 1
                                }
                            }
                        }
                        2 {
                            columns {
                                1 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer1
                                    colPos = 10
                                    colspan = 2
                                }
                                2 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer2
                                    colPos = 11
                                    colspan = 2
                                }
                                3 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer3
                                    colPos = 12
                                    colspan = 2
                                }
                            }
                        }
                    }
                }
            ',
            'icon' => 'EXT:bootstrap_package/Resources/Public/Images/BackendLayouts/default_subnavigation_2_columns.gif'
        ),
        'special_start' => array(
            'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.special_start',
            'config' => '
                backend_layout {
                    colCount = 3
                    rowCount = 4
                    rows {
                        1 {
                            columns {
                                1 {
                                    name = LLL:EXT:cms/locallang_ttc.xlf:colPos.I.3
                                    colPos = 3
                                    colspan = 3
                                }
                            }
                        }
                        2 {
                            columns {
                                1 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.middle1
                                    colPos = 20
                                }
                                2 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.middle2
                                    colPos = 21
                                }
                                3 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.middle3
                                    colPos = 22
                                }
                            }
                        }
                        3 {
                            columns {
                                1 {
                                    name = LLL:EXT:cms/locallang_ttc.xlf:colPos.I.1
                                    colPos = 0
                                    colspan = 3
                                }
                            }
                        }                        
                        4 {
                            columns {
                                1 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer1
                                    colPos = 10
                                }
                                2 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer2
                                    colPos = 11
                                }
                                3 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer3
                                    colPos = 12
                                }
                            }
                        }
                    }
                }
            ',
            'icon' => 'EXT:bootstrap_package/Resources/Public/Images/BackendLayouts/special_start.gif'
        ),
        'special_feature' => array(
            'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.special_feature',
            'config' => '
                backend_layout {
                    colCount = 6
                    rowCount = 8
                    rows {
                        1 {
                            columns {
                                1 {
                                    name = LLL:EXT:cms/locallang_ttc.xlf:colPos.I.3
                                    colPos = 3
                                    colspan = 6
                                }
                            }
                        }
                        2 {
                            columns {
                                1 {
                                    name = LLL:EXT:cms/locallang_ttc.xlf:colPos.I.1
                                    colPos = 0
                                    colspan = 6
                                }
                            }
                        }
                        3 {
                            columns {
                                1 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.special1
                                    colPos = 30
                                    colspan = 3
                                }
                                2 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.special2
                                    colPos = 31
                                    colspan = 3
                                }
                            }
                        }
                        4 {
                            columns {
                                1 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.special3
                                    colPos = 32
                                    colspan = 3
                                }
                                2 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.special4
                                    colPos = 33
                                    colspan = 3
                                }
                            }
                        }
                        5 {
                            columns {
                                1 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.main2
                                    colPos = 4
                                    colspan = 6
                                }
                            }
                        }
                        6 {
                            columns {
                                1 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.special5
                                    colPos = 34
                                    colspan = 3
                                }
                                2 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.special6
                                    colPos = 35
                                    colspan = 3
                                }
                            }
                        }
                        7 {
                            columns {
                                1 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.special7
                                    colPos = 36
                                    colspan = 3
                                }
                                2 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.special8
                                    colPos = 37
                                    colspan = 3
                                }
                            }
                        }
                        8 {
                            columns {
                                1 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer1
                                    colPos = 10
                                    colspan = 2
                                }
                                2 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer2
                                    colPos = 11
                                    colspan = 2
                                }
                                3 {
                                    name = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:backend_layout.column.footer3
                                    colPos = 12
                                    colspan = 2
                                }
                            }
                        }
                    }
                }
            ',
            'icon' => 'EXT:bootstrap_package/Resources/Public/Images/BackendLayouts/special_feature.gif'
        )
    );

    /**
     * @param DataProviderContext $dataProviderContext
     * @param BackendLayoutCollection $backendLayoutCollection
     * @return void
     */
    public function addBackendLayouts(DataProviderContext $dataProviderContext, BackendLayoutCollection $backendLayoutCollection) {
        foreach ($this->backendLayouts as $key => $data) {
            $data['uid'] = $key;
            $backendLayout = $this->createBackendLayout($data);
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
    public function getBackendLayout($identifier, $pageId){
        $backendLayout = NULL;
        if(array_key_exists($identifier,$this->backendLayouts)) {
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
    protected function createBackendLayout(array $data) {
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
    protected function getIconPath($icon) {
        $iconPath = '';
        if (!empty($icon)) {
            $iconPath = $icon;
        }
        return $iconPath;
    }

}