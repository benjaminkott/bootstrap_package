<?php
declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ExpressionLanguage;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;
use TYPO3\CMS\Core\Exception\SiteNotFoundException;
use TYPO3\CMS\Core\Site\SiteFinder;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Provides custom expression language functions for TypoScript/PageTsConfig conditions.
 */
class FunctionsProvider implements ExpressionFunctionProviderInterface
{
    /**
     * @return ExpressionFunction[]
     */
    public function getFunctions(): array
    {
        return [
            $this->getSiteSettingFunction(),
        ];
    }

    protected function getSiteSettingFunction(): ExpressionFunction
    {
        return new ExpressionFunction(
            'siteSetting',
            static fn () => null, // Not used for compilation
            static function (array $arguments, string $settingKey, mixed $default = null): mixed {
                // Try to get page from the expression language context
                $pageId = 0;
                if (isset($arguments['page']['uid'])) {
                    $pageId = (int)$arguments['page']['uid'];
                }

                if ($pageId <= 0) {
                    return $default;
                }

                try {
                    $siteFinder = GeneralUtility::makeInstance(SiteFinder::class);
                    $site = $siteFinder->getSiteByPageId($pageId);
                    $settings = $site->getSettings();
                    return $settings->get($settingKey, $default);
                } catch (SiteNotFoundException) {
                    return $default;
                }
            }
        );
    }
}
