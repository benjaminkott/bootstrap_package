<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Utility;

use TYPO3\CMS\Core\Information\Typo3Version;

/**
 * TcaUtility
 */
class TcaUtility
{
    /**
     * @param list<string> $allowed
     * @param list<string> $disallowed
     * @return array<string, mixed>
     */
    public static function getConfigForFileExtensions(array $allowed = [], array $disallowed = []): array
    {
        $allowedFileExtensions = implode(',', $allowed);
        $disallowedFileExtensions = implode(',', $disallowed);

        if ((new Typo3Version())->getMajorVersion() >= 12) {
            // See https://docs.typo3.org/c/typo3/cms-core/main/en-us/Changelog/12.0/Feature-98479-NewTCATypeFile.html
            return [
                'allowed' => $allowedFileExtensions,
                'disallowed' => $disallowedFileExtensions,
            ];
        }

        // @todo Can be removed once support for TYPO3 v11.5 is dropped
        return [
            'filter' => [
                0 => [
                    'parameters' => [
                        'allowedFileExtensions' => $allowedFileExtensions,
                        'disallowedFileExtensions' => $disallowedFileExtensions,
                    ],
                ],
            ],
            'overrideChildTca' => [
                'columns' => [
                    'uid_local' => [
                        'config' => [
                            'appearance' => [
                                'elementBrowserAllowed' => $allowedFileExtensions,
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
