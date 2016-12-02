<?php
defined('TYPO3_MODE') || die();

/***************
 * Add Content Element: Audio
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['audio'] = 'content-bootstrappackage-audio';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.audio',
        'audio',
        'content-bootstrappackage-audio'
    ],
    'image',
    'after'
);
if (!is_array($GLOBALS['TCA']['tt_content']['types']['audio'])) {
    $GLOBALS['TCA']['tt_content']['types']['audio'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['audio'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['audio'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.media,
            assets,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            rowDescription',
        'columnsOverrides' => [
            'assets' => [
                'config' => [
                    'filter' => [
                        0 => [
                            'parameters' => [
                                'allowedFileExtensions' => 'mp3'
                            ]
                        ]
                    ],
                    'foreign_selector_fieldTcaOverride' => [
                        'config' => [
                            'appearance' => [
                                'elementBrowserAllowed' => 'mp3'
                            ]
                        ]
                    ]
                ]
            ]

        ]
    ]
);
