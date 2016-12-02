<?php
defined('TYPO3_MODE') || die();

/***************
 * Add Content Element: Quote
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['quote'] = 'content-bootstrappackage-quote';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.quote',
        'quote',
        'content-bootstrappackage-quote'
    ],
    'header',
    'after'
);

/***************
 * Configure element type
 */
if (!is_array($GLOBALS['TCA']['tt_content']['types']['quote'])) {
    $GLOBALS['TCA']['tt_content']['types']['quote'] = [];
}
$GLOBALS['TCA']['tt_content']['types']['quote'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['quote'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header.ALT.div_formlabel,
            quote_link;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:quote.link,
            quote_source;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:quote.source,
            bodytext;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:quote.text,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            rowDescription'
    ]
);

/***************
 * Register fields
 */
$GLOBALS['TCA']['tt_content']['columns'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['columns'],
    [
        'quote_source' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:quote.source',
            'config' => [
                'type' => 'input',
                'size' => 50,
                'max' => 255
            ]
        ],
        'quote_link' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:quote.link',
            'config' => [
                'type' => 'input',
                'size' => 50,
                'max' => 1024,
                'eval' => 'trim',
                'wizards' => [
                    'link' => [
                        'type' => 'popup',
                        'title' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:quote.link',
                        'icon' => 'actions-wizard-link',
                        'module' => [
                            'name' => 'wizard_link',
                        ],
                        'JSopenParams' => 'width=800,height=600,status=0,menubar=0,scrollbars=1'
                    ]
                ],
                'softref' => 'typolink'
            ]
        ],
    ]
);
