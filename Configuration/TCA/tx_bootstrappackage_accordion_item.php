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
        'label_alt' => 'bodytext',
        'sortby' => 'sorting',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:accordion_item',
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
        'typeicon_classes' => [
            'default' => 'content-bootstrappackage-accordion-item',
        ]
    ],
    'interface' => [
        'showRecordFieldList' => '
            hidden,
            tt_content,
            header,
            bodytext
        ',
    ],
    'types' => [
        '1' => [
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                header,
                bodytext,
                media,
                --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:accordion_item.mediaposition;mediaposition,
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
        'general' => [
            'showitem' => '
                tt_content
            '
        ],
        'mediaposition' => [
            'showitem' => '
                mediaorient,
                imagecols,
                image_zoom,
            '
        ],
        'visibility' => [
            'showitem' => '
                hidden;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:accordion_item
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
            'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:accordion_item.tt_content',
            'CType',
            ['accordion']
        ),
        'hidden' => TcaUtility::getHidden(),
        'starttime' => TcaUtility::getStartTime(),
        'endtime' => TcaUtility::getEndTime(),
        'sys_language_uid' => TcaUtility::getLanguage(),
        'l10n_parent' => TcaUtility::getLanguageParent('tx_bootstrappackage_icon_group_item'),
        'l10n_diffsource' => TcaUtility::getLanguageDiff(),
        'header' => TcaUtility::getText('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:accordion_item.header', 'trim,required', 50),
        'bodytext' => TcaUtility::getRTE('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:accordion_item.bodytext'),
        'media' => TcaUtility::getMedia('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:accordion_item.bodytext', 'media'),
        'mediaorient' => TcaUtility::getOptions(
            'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:accordion_item.mediaorient',
            [
                ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:accordion_item.mediaorient.left', 'left'],
                ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:accordion_item.mediaorient.top', 'top'],
                ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:accordion_item.mediaorient.right', 'right'],
                ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:accordion_item.mediaorient.bottom', 'bottom'],
            ],
            'left'
        ),
        'imagecols' => TcaUtility::getOptions(
            'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:accordion_item.imagecols',
            [
                ['1', 1],
                ['2', 2],
                ['3', 3],
                ['4', 4],
                ['5', 5],
                ['6', 6]
            ],
            2
        ),
        'image_zoom' => TcaUtility::getToggle('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:accordion_item.image_zoom'),
    ]
];
