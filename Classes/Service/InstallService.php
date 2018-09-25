<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Service;

use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * InstallService
 */
class InstallService
{
    /**
     * @var string
     */
    const EXT_KEY = 'bootstrap_package';

    /**
     * @var string
     */
    protected $messageQueueByIdentifier = '';

    /**
     * Initializes the install service
     */
    public function __construct()
    {
        $this->messageQueueByIdentifier = 'extbase.flashmessages.tx_extensionmanager_tools_extensionmanagerextensionmanager';
    }

    /**
     * @param string $extension
     */
    public function generateApacheHtaccess($extension = null)
    {
        if ($extension === self::EXT_KEY) {
            if (strpos($_SERVER['SERVER_SOFTWARE'], 'Apache') === 0) {
                $this->createConfigurationFile('.htaccess');
            } elseif (strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') === 0) {
                $this->createConfigurationFile('web.config');
            } else {
                /**
                 * Add Flashmessage that the system is not running on a supported webserver and the url rewritings must be handled manually
                 */
                $flashMessage = GeneralUtility::makeInstance(
                    FlashMessage::class,
                    'The Bootstrap Package suggests to use RealUrl to generate SEO friendly URLs, please take care of '
                    . 'the URLs rewriting settings for your environment yourself. You can also deactivate RealUrl by '
                    . 'changing your TypoScript setup to "config.tx_realurl_enable = 0". You also need to take care of '
                    . 'securing configuration files. Example Configurations for Apache and Microsoft IIS can be found '
                    . 'in "typo3conf/ext/bootstrap_package/Configuration/Server/".',
                    'TYPO3 is not running on an Apache or Microsoft-IIS Webserver',
                    FlashMessage::WARNING,
                    true
                );
                $this->addFlashMessage($flashMessage);
                return;
            }
        }
    }

    /**
     * Creates webserver configuration file inside the root directory
     *
     * @param $filename
     */
    private function createConfigurationFile($filename)
    {
        $absFilename = GeneralUtility::getFileAbsFileName($filename);
        if (file_exists($absFilename)) {
            // Add Flashmessage that there is already an configuration file and we are not going to override this.
            $flashMessage = GeneralUtility::makeInstance(
                FlashMessage::class,
                'There is already an ' . $filename . ' configuration file in the root directory, '
                . 'please make sure that configuration files are protected and the url rewritings are set properly. '
                . 'An example configuration is located at: "typo3conf/ext/bootstrap_package/Configuration/Server/_' . $filename . '"',
                'Webserver coniguration file "' . $filename . '" already exists',
                FlashMessage::NOTICE,
                true
            );
            $this->addFlashMessage($flashMessage);
            return;
        }

        $filecontent = GeneralUtility::getUrl(ExtensionManagementUtility::extPath(self::EXT_KEY) . '/Configuration/Server/_' . $filename);
        if ($filecontent && is_string($filecontent)) {
            GeneralUtility::writeFile($absFilename, $filecontent, true);
            // Add Flashmessage that the example configuration file was placed in the root directory
            $flashMessage = GeneralUtility::makeInstance(
                FlashMessage::class,
                'For securing configuration files and optimization purposes an example ' . $filename . ' file was placed in your root directory.',
                'Webserver coniguration file "' . $filename . '" was placed in the root directory.',
                FlashMessage::OK,
                true
            );
            $this->addFlashMessage($flashMessage);
        }
    }

    /**
     * Adds a Flash Message to the Flash Message Queue
     *
     * @param FlashMessage $flashMessage
     */
    public function addFlashMessage(FlashMessage $flashMessage)
    {
        $flashMessageService = GeneralUtility::makeInstance(FlashMessageService::class);
        $flashMessageQueue = $flashMessageService->getMessageQueueByIdentifier($this->messageQueueByIdentifier);
        $flashMessageQueue->enqueue($flashMessage);
    }
}
