<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use BK2K\BootstrapPackage\Utility\TcaUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

if (ExtensionManagementUtility::isLoaded('lang')) {
    $generalLanguageFile = 'EXT:lang/Resources/Private/Language/locallang_general.xlf';
} else {
    $generalLanguageFile = 'EXT:core/Resources/Private/Language/locallang_general.xlf';
}

return [
    'ctrl' => [
        'label' => 'header',
        'sortby' => 'sorting',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item',
        'type' => 'item_type',
        'delete' => 'deleted',
        'versioningWS' => true,
        'origUid' => 't3_origuid',
        'hideTable' => true,
        'hideAtCopy' => true,
        'prependAtCopy' => 'LLL:' . $generalLanguageFile . ':LGL.prependAtCopy',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'languageField' => 'sys_language_uid',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'typeicon_column' => 'item_type',
        'typeicon_classes' => [
            'default' => 'content-bootstrappackage-carousel-item',
            'header' => 'content-bootstrappackage-carousel-item-header',
            'call_to_action' => 'content-bootstrappackage-carousel-item-calltoaction',
            'image' => 'content-bootstrappackage-carousel-item-image',
            'text' => 'content-bootstrappackage-carousel-item-text',
            'text_and_image' => 'content-bootstrappackage-carousel-item-textandimage',
            'background_image' => 'content-bootstrappackage-carousel-item-backgroundimage',
            'html' => 'content-bootstrappackage-carousel-item-html'
        ]
    ],
    'interface' => [
        'showRecordFieldList' => '
            hidden,
            tt_content,
            header,
            header_layout,
            header_class,
            subheader,
            subheader_layout,
            subheader_class
            bodytext,
            image,
            text_color,
            background_color,
            background_image
        ',
    ],
    'types' => [
        '1' => [
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header.ALT.html_formlabel,
                nav_title,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --palette--;;hiddenLanguagePalette,
            '
        ],
        'header' => [
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.header;header,
                nav_title,
                text_color,
                link,
                --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tabs.background,
                background_color,
                background_image,
                background_image_options,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --palette--;;hiddenLanguagePalette,
            '
        ],
        'text' => [
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.header;header,
                nav_title,
                bodytext,
                text_color,
                --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tabs.background,
                background_color,
                background_image,
                background_image_options,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --palette--;;hiddenLanguagePalette,
            '
        ],
        'call_to_action' => [
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.header;header,
                nav_title,
                bodytext,
                button_text,
                link,
                --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tabs.background,
                background_color,
                background_image,
                background_image_options,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --palette--;;hiddenLanguagePalette,
            '
        ],
        'image' => [
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header.ALT.html_formlabel,
                nav_title,
                image,
                link,
                --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tabs.background,
                background_color,
                background_image,
                background_image_options,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --palette--;;hiddenLanguagePalette,
            '
        ],
        'text_and_image' => [
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.header;header,
                nav_title,
                bodytext,
                text_color,
                image,
                link,
                --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tabs.background,
                background_color,
                background_image,
                background_image_options,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --palette--;;hiddenLanguagePalette,
            '
        ],
        'background_image' => [
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header.ALT.html_formlabel,
                nav_title,
                background_color,
                background_image,
                background_image_options,
                link,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --palette--;;hiddenLanguagePalette,
            '
        ],
        'html' => [
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header.ALT.html_formlabel,
                nav_title,
                bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext.ALT.html_formlabel,
                --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tabs.background,
                background_color,
                background_image,
                background_image_options,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --palette--;;hiddenLanguagePalette,
            '
        ],
    ],
    'palettes' => [
        '1' => [
            'showitem' => ''
        ],
        'access' => [
            'showitem' => '
                starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,
                endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel
            '
        ],
        'header' => [
            'showitem' => '
                header,
                header_layout,
                header_class,
                --linebreak--,
                subheader,
                subheader_layout,
                subheader_class,
                --linebreak--,
                header_position,
            '
        ],
        'general' => [
            'showitem' => '
                tt_content,
                item_type;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:CType_formlabel,
            '
        ],
        'visibility' => [
            'showitem' => '
                hidden;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item
            '
        ],
        // hidden but needs to be included all the time, so sys_language_uid is set correctly
        'hiddenLanguagePalette' => [
            'showitem' => 'sys_language_uid, l10n_parent',
            'isHiddenPalette' => true,
        ],
    ],
    'columns' => [
        'tt_content' => TcaUtility::getContentElementRelation(
            'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.tt_content',
            'CType',
            ['carousel', 'carousel_small', 'carousel_fullscreen']
        ),
        'hidden' => TcaUtility::getHidden(),
        'starttime' => TcaUtility::getStartTime(),
        'endtime' => TcaUtility::getEndTime(),
        'sys_language_uid' => TcaUtility::getLanguage(),
        'l10n_parent' => TcaUtility::getLanguageParent('tx_bootstrappackage_carousel_item'),
        'l10n_diffsource' => TcaUtility::getLanguageDiff(),
        'item_type' => TcaUtility::getOptions(
            'LLL:' . $generalLanguageFile . ':LGL.type',
            [
                ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.item_type.header', 'header', 'content-bootstrappackage-carousel-item-header'],
                ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.item_type.text', 'text', 'content-bootstrappackage-carousel-item-text'],
                ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.item_type.calltoaction', 'call_to_action', 'content-bootstrappackage-carousel-item-calltoaction'],
                ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.item_type.image', 'image', 'content-bootstrappackage-carousel-item-image'],
                ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.item_type.textandimage', 'text_and_image', 'content-bootstrappackage-carousel-item-textandimage'],
                ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.item_type.backgroundimage', 'background_image', 'content-bootstrappackage-carousel-item-backgroundimage'],
                ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.item_type.html', 'html', 'content-bootstrappackage-carousel-item-html']
            ],
            'header'
        ),
        'link' => TcaUtility::getLink('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.link'),
        'header' => TcaUtility::getText('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.header', 'trim,required', 50),
        'header_layout' => TcaUtility::getOptions(
            'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.header_layout',
            [
                ['H1', '1'],
                ['H2', '2'],
                ['H3', '3'],
                ['H4', '4'],
            ],
            1
        ),
        'header_position' => TcaUtility::getOptions(
            'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.header_position',
            [
                ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.header_position.default', ''],
                ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.header_position.center', 'center'],
                ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.header_position.right', 'right'],
                ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.header_position.left', 'left'],
            ],
            ''
        ),
        'header_class' => TcaUtility::getOptions(
            'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.header_class',
            [
                ['', 'none'],
                ['h1', 'h1'],
                ['h2', 'h2'],
                ['h3', 'h3'],
                ['h4', 'h4'],
                ['h5', 'h5'],
            ],
            ''
        ),
        'subheader' => TcaUtility::getText('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.subheader'),
        'subheader_layout' => TcaUtility::getOptions(
            'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.subheader_layout',
            [
                ['H2', '2'],
                ['H3', '3'],
                ['H4', '4'],
            ],
            2
        ),
        'subheader_class' => TcaUtility::getOptions(
            'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.subheader_class',
            [
                ['', 'none'],
                ['h1', 'h1'],
                ['h2', 'h2'],
                ['h3', 'h3'],
                ['h4', 'h4'],
                ['h5', 'h5']
            ],
            ''
        ),
        'nav_title' => TcaUtility::getText('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.nav_title'),
        'bodytext' => TcaUtility::getRTE('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.bodytext'),
        'button_text' => TcaUtility::getText('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.button_text'),
        'image' => TcaUtility::getImage('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.image', 'image'),
        'text_color' => TcaUtility::getColor('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.text_color', '#FFFFFF'),
        'background_color' => TcaUtility::getColor('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.background_color', '#333333'),
        'background_image' => TcaUtility::getSimpleImage('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item.background_image', 'background_image'),
        'background_image_options' => TcaUtility::getFlexform(
            'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.background_image_options',
            'FILE:EXT:bootstrap_package/Configuration/FlexForms/BackgroundImage.xml'
        )
    ],
];
