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
        'label_userFunc' => BK2K\BootstrapPackage\Userfuncs\Tca::class . '->timelineItemLabel',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:timeline_item',
        'delete' => 'deleted',
        'versioningWS' => true,
        'origUid' => 't3_origuid',
        'hideTable' => true,
        'hideAtCopy' => true,
        'prependAtCopy' => 'LLL:' . $generalLanguageFile . ':LGL.prependAtCopy',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'languageField' => 'sys_language_uid',
        'default_sortby' => 'date',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'typeicon_classes' => [
            'default' => 'content-bootstrappackage-timeline-item'
        ],
    ],
    'interface' => [
        'showRecordFieldList' => '
            hidden,
            tt_content,
            header
        ',
    ],
    'types' => [
        '1' => [
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                date,
                header,
                bodytext,
                icon_file,
                image,
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
        'visibility' => [
            'showitem' => '
                hidden;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:timeline_item
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
            'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:timeline_item.tt_content',
            'CType',
            ['timeline']
        ),
        'hidden' => TcaUtility::getHidden(),
        'starttime' => TcaUtility::getStartTime(),
        'endtime' => TcaUtility::getEndTime(),
        'sys_language_uid' => TcaUtility::getLanguage(),
        'l10n_parent' => TcaUtility::getLanguage('tx_bootstrappackage_timeline_item'),
        'l10n_diffsource' => TcaUtility::getLanguageDiff(),
        'date' => TcaUtility::getDateTime('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:timeline_item.date'),
        'header' => TcaUtility::getText('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:timeline_item.header', 'trim,required', 50),
        'bodytext' => TcaUtility::getRTE('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:timeline_item.bodytext'),
        'icon_file' => TcaUtility::getIcon('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:timeline_item.icon_file', 'icon_file'),
        'image' => TcaUtility::getImage('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:timeline_item.image', 'image'),
    ]
];
