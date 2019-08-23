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
        'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item',
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
            'default' => 'content-bootstrappackage-card-group-item'
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
                --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.header;header,
                image,
                bodytext,
                --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.link;link,
                icon_file,
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
                --linebreak--,
                subheader,
            '
        ],
        'link' => [
            'showitem' => '
                link,
                link_title,
                --linebreak--,
                link_icon,
                link_class,
            '
        ],
        'general' => [
            'showitem' => '
                tt_content
            '
        ],
        'visibility' => [
            'showitem' => '
                hidden;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item
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
            'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.tt_content',
            'CType',
            ['card_group']
        ),
        'hidden' => TcaUtility::getHidden(),
        'starttime' => TcaUtility::getStartTime(),
        'endtime' => TcaUtility::getEndTime(),
        'sys_language_uid' => TcaUtility::getLanguage(),
        'l10n_parent' => TcaUtility::getLanguageParent('tx_bootstrappackage_card_group_item'),
        'l10n_diffsource' => TcaUtility::getLanguageDiff(),
        'header' => TcaUtility::getText('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.header', 'trim,required', 50),
        'subheader' => TcaUtility::getText('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.subheader'),
        'bodytext' => TcaUtility::getRTE('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.bodytext'),
        'image' => TcaUtility::getImage('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.image', 'image'),
        'link' => TcaUtility::getLink('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.link'),
        'link_title' => TcaUtility::getText('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.link_title'),
        'link_icon' => TcaUtility::getIcon('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.link_icon', 'link_icon'),
        'link_class' => TcaUtility::getOptions(
            'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:card_group_item.link_class',
            [
                ['default', 'default'],
                ['primary', 'primary'],
                ['secondary', 'secondary'],
                ['success', 'success'],
                ['info', 'info'],
                ['warning', 'warning'],
                ['danger', 'danger'],
                ['outline-default', 'outline-default'],
                ['outline-primary', 'outline-primary'],
                ['outline-secondary', 'outline-secondary'],
                ['outline-success', 'outline-success'],
                ['outline-info', 'outline-info'],
                ['outline-warning', 'outline-warning'],
                ['outline-danger', 'outline-danger'],
            ],
            'default'
        ),
    ],
];
