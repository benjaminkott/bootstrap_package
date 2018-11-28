<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Slot;

/**
 * LanguageMenuSlot
 */
class LanguageMenuSlot
{
    /**
     * Adds additional TCA fields to sys_language
     *
     * @param array $tca
     * @return array
     */
    public function addTcaFields(array $tca): array
    {
        // Add columns
        $tca['sys_language']['columns'] = array_merge_recursive(
            $tca['sys_language']['columns'],
            [
                'title' => [
                    'config' => [
                        'placeholder' => 'English'
                    ]
                ],
                'nav_title' => [
                    'label' => 'Navigation title (e.g. "English", "Deutsch", "Français")',
                    'config' => [
                        'type' => 'input',
                        'size' => 10,
                        'placeholder' => 'English',
                        'eval' => 'trim'
                    ]
                ],
                'locale' => [
                    'label' => 'Language locale',
                    'description' => 'should be something like de_DE or en_US.UTF-8',
                    'config' => [
                        'type' => 'input',
                        'placeholder' => 'en_US.UTF-8',
                        'eval' => 'trim,required',
                        'fieldInformation' => [
                            'AdditionalFieldInformation' => [
                                'renderType' => 'AdditionalFieldInformation',
                            ]
                        ]
                    ]
                ],
                'hreflang' => [
                    'label' => 'Language tag defined by RFC 1766 / 3066 for "lang" and "hreflang" attributes',
                    'config' => [
                        'type' => 'input',
                        'placeholder' => 'en-US',
                        'eval' => 'trim,required'
                    ]
                ],
                'direction' => [
                    'label' => 'Language direction for "dir" attribute',
                    'config' => [
                        'type' => 'select',
                        'renderType' => 'selectSingle',
                        'items' => [
                            ['Left to Right', 'ltr'],
                            ['Right to Left', 'rtl']
                        ],
                        'size' => 1
                    ]
                ]
            ]
        );

        // Add fields to
        $tca['sys_language']['types'][1] = array_replace_recursive(
            $tca['sys_language']['types'][1],
            [
                'showitem' => '
                    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                        title,
                        nav_title,
                        locale,
                        hreflang,
                        direction,
                        language_isocode,
                        flag,
                    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                        hidden,
                    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended
                '
            ]
        );

        return [$tca];
    }
}
