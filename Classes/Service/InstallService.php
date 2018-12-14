<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Service;

use TYPO3\CMS\Core\Messaging\FlashMessage;
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
    protected $extKey = 'bootstrap_package';

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
        if ($extension == $this->extKey) {
            if (substr($_SERVER['SERVER_SOFTWARE'], 0, 6) === 'Apache') {
                $this->createDefaultHtaccessFile();
            } else {
                /**
                 * Add Flashmessage that the system is not running on an apache webserver and the url rewritings must be handled manually
                 */
                $flashMessage = GeneralUtility::makeInstance(
                    'TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
                    'The Bootstrap Package uses RealUrl to generate SEO friendly URLs by default, please take care of the URLs rewriting settings for your environment yourself.'
                    . 'You can also deactivate RealUrl by changing your TypoScript setup to "config.tx_realurl_enable = 0".',
                    'TYPO3 is not running on an Apache-Webserver',
                    FlashMessage::WARNING,
                    true
                );
                $this->addFlashMessage($flashMessage);
                return;
            }
        }
    }

    /**
     * Creates .htaccess file inside the root directory
     *
     * @return void
     */
    public function createDefaultHtaccessFile()
    {
        $htaccessFile = GeneralUtility::getFileAbsFileName('.htaccess');
        if (file_exists($htaccessFile)) {
            /**
             * Add Flashmessage that there is already an .htaccess file and we are not going to override this.
             */
            $flashMessage = GeneralUtility::makeInstance(
                'TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
                'There is already an Apache .htaccess file in the root directory, please make sure that the url rewritings are set properly.'
                . 'An example configuration is located at: "typo3conf/ext/bootstrap_package/Configuration/Apache/.htaccess"',
                'Apache .htaccess file already exists',
                FlashMessage::NOTICE,
                true
            );
            $this->addFlashMessage($flashMessage);
            return;
        }
        $htaccessContent = GeneralUtility::getUrl(ExtensionManagementUtility::extPath($this->extKey) . '/Configuration/Apache/.htaccess');
        GeneralUtility::writeFile($htaccessFile, $htaccessContent, true);

        /**
         * Add Flashmessage that the example htaccess file was placed in the root directory
         */
        $flashMessage = GeneralUtility::makeInstance(
            'TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
            'For RealURL and optimization purposes an example .htaccess file was placed in your root directory.'
            . ' Please check if the RewriteBase correctly set for your environment. ',
            'Apache example .htaccess was placed in the root directory.',
            FlashMessage::OK,
            true
        );
        $this->addFlashMessage($flashMessage);
    }

    /**
     * Adds a Flash Message to the Flash Message Queue
     *
     * @param FlashMessage $flashMessage
     */
    public function addFlashMessage(FlashMessage $flashMessage)
    {
        if ($flashMessage) {
            /** @var $flashMessageService \TYPO3\CMS\Core\Messaging\FlashMessageService */
            $flashMessageService = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessageService');
            /** @var $flashMessageQueue \TYPO3\CMS\Core\Messaging\FlashMessageQueue */
            $flashMessageQueue = $flashMessageService->getMessageQueueByIdentifier($this->messageQueueByIdentifier);
            $flashMessageQueue->enqueue($flashMessage);
        }
    }
}
