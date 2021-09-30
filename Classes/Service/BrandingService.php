<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Service;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Package\Event\AfterPackageActivationEvent;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * BrandingService
 */
class BrandingService
{
    public function __invoke(AfterPackageActivationEvent $event): void
    {
        if ($event->getPackageKey() === 'bootstrap_package') {
            $this->setBackendStyling();
        }
    }

    public function setBackendStyling(): void
    {
        if (class_exists(ExtensionConfiguration::class)) {
            $extensionConfiguration = GeneralUtility::makeInstance(
                ExtensionConfiguration::class
            );
            $backendConfiguration = $extensionConfiguration->get('backend');

            if (!isset($backendConfiguration['loginLogo']) || trim($backendConfiguration['loginLogo']) === '') {
                $backendConfiguration['loginLogo'] = 'EXT:bootstrap_package/Resources/Public/Images/Backend/login-logo.svg';
            }
            if (!isset($backendConfiguration['loginBackgroundImage']) || trim($backendConfiguration['loginBackgroundImage']) === '') {
                $backendConfiguration['loginBackgroundImage'] = 'EXT:bootstrap_package/Resources/Public/Images/Backend/login-background-image.jpg';
            }
            if (!isset($backendConfiguration['backendLogo']) || trim($backendConfiguration['backendLogo']) === '') {
                $backendConfiguration['backendLogo'] = 'EXT:bootstrap_package/Resources/Public/Images/Backend/backend-logo.svg';
            }

            // Workaround for
            // https://review.typo3.org/c/Packages/TYPO3.CMS/+/62650
            $reflection = new \ReflectionClass(ExtensionConfiguration::class);
            $parameters = $reflection->getMethod('set')->getParameters();
            $arguments = [];
            $arguments[] = 'backend';
            if (count($parameters) === 3) {
                $arguments[] = '';
            }
            $arguments[] = $backendConfiguration;

            $extensionConfiguration->set(...$arguments);
        }
    }
}
