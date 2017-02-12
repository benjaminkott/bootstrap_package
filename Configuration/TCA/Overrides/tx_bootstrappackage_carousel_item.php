<?php
defined('TYPO3_MODE') || die();

// Activate T3EDITOR if extension is activated
if (TYPO3_MODE === 'BE' && \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('t3editor')) {
    $GLOBALS['TCA']['tx_bootstrappackage_carousel_item']['types']['html']['columnsOverrides'] = [
        'bodytext' => [
            'config' => [
                'renderType' => 't3editor',
                'wrap' => 'off',
                'format' => 'html'
            ]
        ]
    ];
}
