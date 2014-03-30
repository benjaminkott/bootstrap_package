<?php
namespace BK2K\BootstrapPackage\Service;

/***************************************************************
 * 
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
 *
 ***************************************************************/

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Messaging\FlashMessageQueue;

/**
 * @author Benjamin Kott <info@bk2k.info>
 */
class InstallService {
    
    protected $extKey = 'bootstrap_package';
    
    /**
     * @param string $extension
     */
    public function generateApacheHtaccess($extension = NULL){
        if($extension == $this->extKey){
            if(substr($_SERVER['SERVER_SOFTWARE'], 0, 6) === 'Apache'){
                $this->createDefaultHtaccessFile();
            }else{

                /**
                 * Add Flashmessage that the system it not running on an apache webserver and the url rewritings must be handled manually
                 */
                $message = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
                   'The Bootstrap Package uses RealUrl to generate SEO friendly URLs by default, please take care of the URLs rewriting settings for your environment yourself.<br>'
                    . 'You can also deactivate RealUrl by changing your TypoScript setup to "<strong>config.tx_realurl_enable = 0</strong>".',
                   'TYPO3 is not running on an Apache-Webserver',
                   FlashMessage::WARNING,
                   TRUE
                );
                FlashMessageQueue::addMessage($message);
                return;
            }
        }
    }

    /**
	 * Creates .htaccess file inside the root directory
	 *
	 * @param string $htaccessFile Path of .htaccess file
	 * @return void
	 */
    public function createDefaultHtaccessFile(){
        $htaccessFile = GeneralUtility::getFileAbsFileName(".htaccess");
                
        if(file_exists($htaccessFile)){
            
            /**
             * Add Flashmessage that there is already an .htaccess file and we are not going to override this.
             */
            $message = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
                'There is already an Apache .htaccess file in the root directory, please make sure that the url rewritings are set properly.<br>'
                . 'An example configuration is located at: <strong>typo3conf/ext/bootstrap_package/Configuration/Apache/.htaccess</strong>',
                'Apache .htaccess file already exists',
                FlashMessage::NOTICE,
                TRUE
            );
            FlashMessageQueue::addMessage($message);
			return;
		}
                   
        $htaccessContent = GeneralUtility::getUrl(ExtensionManagementUtility::extPath($this->extKey).'/Configuration/Apache/.htaccess');
        GeneralUtility::writeFile($htaccessFile, $htaccessContent, TRUE);
        
        /**
         * Add Flashmessage that the example htaccess file was placed in the root directory
         */
        $message = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
            'For RealURL and optimization purposes an example .htaccess file was placed in your root directory. <br>'
            . ' Please check if the RewriteBase correctly set for your environment. ',
            'Apache example .htaccess was placed in the root directory.',
            FlashMessage::OK,
            TRUE
       );
       FlashMessageQueue::addMessage($message);
    }
    
}