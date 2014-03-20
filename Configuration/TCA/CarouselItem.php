<?php
if(!defined('TYPO3_MODE')){
    die('Access denied.');
}


$TCA['tx_bootstrappackage_carousel_item'] = array(
    'ctrl' => $TCA['tx_bootstrappackage_carousel_item']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => '
            hidden,
            tt_content,
            header,
            bodytext,
            image,
            text_color,
            background_style,
            background_color,
            background_image
        ',
    ),
    'types' => array(
        '1' => array('showitem' => '
            --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
            header,
            bodytext,
            image,
            text_color,
            --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tabs.background,
            --palette--;;background,
            --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
        '),
        'header' => array('showitem' => '
            --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
            header,
            text_color,
            --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tabs.background,
            --palette--;;background,
            --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
        '),
        'textandimage' => array('showitem' => '
            --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
            header;LLL:EXT:cms/locallang_ttc.xlf:header.ALT.html_formlabel,
            image,
            --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tabs.background,
            --palette--;;background,
            --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
        '),
        'html' => array('showitem' => '
            --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
            header;LLL:EXT:cms/locallang_ttc.xlf:header.ALT.html_formlabel,
            bodytext;LLL:EXT:cms/locallang_ttc.xlf:bodytext.ALT.html_formlabel;;nowrap:wizards[t3editor],
            --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tabs.background,
            --palette--;;background,
            --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
        '),
    ),
    'palettes' => array(
        '1' => array(
            'showitem' => ''
        ),
        'access' => array(
            'showitem' => '
                starttime;LLL:EXT:cms/locallang_ttc.xlf:starttime_formlabel, 
                endtime;LLL:EXT:cms/locallang_ttc.xlf:endtime_formlabel
            ',
            'canNotCollapse' => 1
        ),
        'background' => array(
            'showitem' => '
                background_style,
                --linebreak--,
                background_color,
                background_image,
            ',
            'canNotCollapse' => 1
        ),
        'general' => array(
            'showitem' => '
                tt_content,
                item_type;LLL:EXT:cms/locallang_ttc.xlf:CType_formlabel, 
            ',
            'canNotCollapse' => 1
        ),
        'visibility' => array(
            'showitem' => '
                hidden;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item
            ',
            'canNotCollapse' => 1
        ),
    ),
    'columns' => array(
        'tt_content' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.tt_content',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tt_content',
                'foreign_table_where' => 'AND tt_content.pid=###CURRENT_PID### AND tt_content.CType="bootstrap_package_carousel"',
                'maxitems' => 1,
            ),
        ),
        'item_type' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.type',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array(
                        'LLL:EXT:cms/locallang_ttc.xlf:CType.I.0',
                        'header',
                        'i/tt_content_header.gif'
                    ),
                    array(
                        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.item_type.textandimage',
                        'textandimage',
                        'i/tt_content_image.gif'
                    ),
                    array(
                        'LLL:EXT:cms/locallang_ttc.xlf:CType.I.17',
                        'html',
                        'i/tt_content_html.gif'
                    ),
                ),
                'default' => 'header',
                'authMode' => $GLOBALS['TYPO3_CONF_VARS']['BE']['explicitADmode'],
                'authMode_enforce' => 'strict',
                'iconsInOptionTags' => 1,
                'noIconsBelowSelect' => 1
            )
        ),
        'hidden' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => array(
                'type' => 'check',
                'items' => array(
                    '1' => array(
                        '0' => 'LLL:EXT:cms/locallang_ttc.xlf:hidden.I.0'
                    )
                )
            )
        ),
        'starttime' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => array(
                'type' => 'input',
                'size' => '13',
                'max' => '20',
                'eval' => 'datetime',
                'default' => '0'
            ),
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly'
        ),
        'endtime' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => array(
                'type' => 'input',
                'size' => '13',
                'max' => '20',
                'eval' => 'datetime',
                'default' => '0',
                'range' => array(
                    'upper' => mktime(0, 0, 0, 12, 31, 2020)
                )
            ),
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly'
        ),
        'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array(
						'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
						-1
					),
					array(
						'LLL:EXT:lang/locallang_general.xlf:LGL.default_value',
						0
					)
				)
			)
		),
        'l10n_parent' => Array (
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => Array (
				'type' => 'select',
				'items' => Array (
					Array('', 0),
				),
				'foreign_table' => 'tx_bootstrappackage_carousel_item',
				'foreign_table_where' => 'AND tx_bootstrappackage_carousel_item.uid=###REC_FIELD_l10n_parent### AND tx_bootstrappackage_carousel_item.sys_language_uid IN (-1,0)',
			)
		),
		'l10n_diffsource' => Array(
			'config'=>array(
				'type'=>'passthrough'
			)
		),
        'header' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.header',
            'config' => array(
                'type' => 'input',
                'size' => 50,
                'eval' => 'trim,required'
            ),
        ),
        'bodytext' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.bodytext',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'wizards' => array(
                    't3editor' => array(
                        'enableByTypeConfig' => 1,
                        'type' => 'userFunc',
                        'userFunc' => 'TYPO3\\CMS\\T3editor\\FormWizard->main',
                        'title' => 't3editor',
                        'icon' => 'wizard_table.gif',
                        'script' => 'wizard_table.php',
                        'params' => array(
                            'format' => 'html',
                            'style' => 'width:98%; height: 60%;'
                        ),
                    ),
                ),
            ),
        ),
        'image' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'image', 
                array(
                    'foreign_types' => array(
                        '0' => array(
                            'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                        ),
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
                            'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                        ),
                    ),
                    'minitems' => 0,
                    'maxitems' => 1,
                ),
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ),
        'text_color' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.text_color',
            'config' => array(
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim',
                'default' => '#FFFFFF',
                'wizards' => array(
                    'colorChoice' => array(
                         'type' => 'colorbox',
                         'title' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.colorPick',
                         'script' => 'wizard_colorpicker.php',
                         'dim' => '20x20',
                         'JSopenParams' => 'height=600,width=380,status=0,menubar=0,scrollbars=1',
                     ),
                ),
            ),
        ),
        'background_style' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.background_style',
            'config' => array(
                'type' => 'select',
                'default' => '0',
                'items' => array(
                    array('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.background_style.0', 0),
                    array('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.background_style.1', 1),
                ),
            ),
        ),
        'background_color' => array(
            'displayCond' => 'FIELD:background_style:=:0',
            'exclude' => 0,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.background_color',
            'config' => array(
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim',
                'default' => '#333333',
                'wizards' => array(
                    'colorChoice' => array(
                         'type' => 'colorbox',
                         'title' => 'LLL:EXT:examples/locallang_db.xml:tx_examples_haiku.colorPick',
                         'script' => 'wizard_colorpicker.php',
                         'dim' => '20x20',
                         'JSopenParams' => 'height=600,width=380,status=0,menubar=0,scrollbars=1',
                     ),
                ),
            ),
        ),
        'background_image' => array(
            'displayCond' => 'FIELD:background_style:=:1',
            'exclude' => 0,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.background_image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'background_image', 
                array(
                    'foreign_types' => array(
                        '0' => array(
                            'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                        ),
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
                            'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                        ),
                    ),
                    'minitems' => 1,
                    'maxitems' => 1
                ),
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ),
    ),
);