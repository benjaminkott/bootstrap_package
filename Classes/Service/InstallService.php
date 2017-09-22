<?php
namespace BK2K\BootstrapPackage\Service;

/*
 *  The MIT License (MIT)
 *
 *  Copyright (c) 2014 Benjamin Kott, http://www.bk2k.info
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in
 *  all copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *  THE SOFTWARE.
 */

use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * @author Benjamin Kott <info@bk2k.info>
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
                $this->createConfigurationFile('.htaccess');
            } elseif (substr($_SERVER['SERVER_SOFTWARE'], 0, 13) === 'Microsoft-IIS') {
                $this->createConfigurationFile('web.config');
            } else {
                /**
                 * Add Flashmessage that the system is not running on a supported webserver and the url rewritings must be handled manually
                 */
                $flashMessage = GeneralUtility::makeInstance(
                    'TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
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
     * @return void
     */
    private function createConfigurationFile($filename)
    {
        $absFilename = GeneralUtility::getFileAbsFileName($filename);
        if (file_exists($absFilename)) {
            /**
             * Add Flashmessage that there is already an configuration file and we are not going to override this.
             */
            $flashMessage = GeneralUtility::makeInstance(
                'TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
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
        $filecontent = GeneralUtility::getUrl(ExtensionManagementUtility::extPath($this->extKey) . '/Configuration/Server/_' . $filename);
        GeneralUtility::writeFile($absFilename, $filecontent, true);

        /**
         * Add Flashmessage that the example configuration file was placed in the root directory
         */
        $flashMessage = GeneralUtility::makeInstance(
            'TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
            'For securing configuration files and optimization purposes an example ' . $filename . ' file was placed in your root directory.',
            'Webserver coniguration file "' . $filename . '" was placed in the root directory.',
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
