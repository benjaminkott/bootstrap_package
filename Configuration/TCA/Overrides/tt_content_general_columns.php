<?php
defined('TYPO3_MODE') || die();

/***************
 * Adjust columns for generic usage
 */
$GLOBALS['TCA']['tt_content']['columns']['teaser'] = [
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.teaser',
    'exclude' => true,
    'config' => [
        'type' => 'text',
        'softref' => 'rtehtmlarea_images,typolink_tag',
        'cols' => '40',
        'rows' => '3'
    ]
];
$GLOBALS['TCA']['tt_content']['columns']['assets'] = [
    'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.assets',
    'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
        'assets',
        [
            'foreign_types' => $GLOBALS['TCA']['tt_content']['columns']['image']['config']['foreign_types']
        ],
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext']
    )
];

/***************
 * Add additional frame class items
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'frame_class',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.frame_class.well',
        'well'
    ],
    'indent-right',
    'after'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'frame_class',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.frame_class.jumbotron',
        'jumbotron'
    ],
    'well',
    'after'
);
