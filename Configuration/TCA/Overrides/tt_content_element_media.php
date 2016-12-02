<?php
defined('TYPO3_MODE') || die();

/***************
 * Add Content Element: Media
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['media'] = 'mimetypes-x-content-multimedia';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.media',
        'media',
        'mimetypes-x-content-multimedia'
    ],
    'image',
    'after'
);
if (!is_array($GLOBALS['TCA']['tt_content']['types']['media'])) {
    $GLOBALS['TCA']['tt_content']['types']['media'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['media'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['media'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.media,
            imagecols,
            assets,
            imagecols,
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
                                'allowedFileExtensions' => 'youtube, vimeo'
                            ]
                        ]
                    ],
                    'foreign_selector_fieldTcaOverride' => [
                        'config' => [
                            'appearance' => [
                                'elementBrowserAllowed' => 'youtube, vimeo'
                            ]
                        ]
                    ]
                ]
            ]

        ]
    ]
);
