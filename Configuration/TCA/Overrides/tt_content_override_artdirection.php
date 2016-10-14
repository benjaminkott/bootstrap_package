<?php
if (!defined('TYPO3_MODE')) {
        die ('Access denied.');
}

/***************
 * Register fields
 */
$GLOBALS['TCA']['tt_content']['columns']['tx_image_rendering'] = [
        'exclude' => 0,
        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.image_rendering',
        'config' => [
                'type' => 'select',
                'items' => [
                        ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.image_rendering_options.I.0', '0'],
                        ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.image_rendering_options.I.1', '1'],
                        ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.image_rendering_options.I.2', '2'],
                        ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.image_rendering_options.I.3', '3'],
                        ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.image_rendering_options.I.4', '4'],
                      ],
                'size' => 1,
                'maxitems' => 1,
              ]
      ];

$GLOBALS['TCA']['tt_content']['columns']['tx_image_cssselector'] = [
              'exclude' => 0,
              'config' => [
                      'type' => 'input',
                      'max' => 256,
                      'size' => 10,
                ],
             'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.image_cssselector',
      ];

$GLOBALS['TCA']['tt_content']['palettes']['imageblock']['showitem'] .= ',
        --linebreak--,
        tx_image_rendering,
        tx_image_cssselector,
        --linebreak--';
