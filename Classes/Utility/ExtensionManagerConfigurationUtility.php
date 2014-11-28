<?php
namespace BK2K\BootstrapPackage\Utility;

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

use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * @author Benjamin Kott <info@bk2k.info>
 */
class ExtensionManagerConfigurationUtility {

	/**
	 * @var integer
	 */
	protected $errorType = FlashMessage::OK;

	/**
	 * @var string
	 */
	protected $header;

	/**
	 * @var string
	 */
	protected $preText;

	/**
	 * @var array
	 */
	protected $problems = array();

	/**
	 * @var array
	 */
	protected $extConf = array();

	/**
	 * Set the error level if no higher level
	 * is set already
	 *
	 * @param string $level One out of error, ok, warning, info
	 * @return void
	 */
	private function setErrorLevel($level) {

		switch ($level) {
			case 'error':
				$this->errorType = FlashMessage::ERROR;
				$this->header = 'Errors found in your configuration';
				$this->preText = 'Bootstrap Package will not work until these problems have been resolved:<br />';
				break;
			case 'warning':
				if ($this->errorType < FlashMessage::ERROR) {
					$this->errorType = FlashMessage::WARNING;
					$this->header = 'Warnings about your configuration';
					$this->preText = 'Bootstrap Package might behave different than expected:<br />';
				}
				break;
			case 'info':
				if ($this->errorType < FlashMessage::WARNING) {
					$this->errorType = FlashMessage::INFO;
					$this->header = 'Additional information';
					$this->preText = '<br />';
				}
				break;
			case 'ok':
				if ($this->errorType < FlashMessage::WARNING && $this->errorType != FlashMessage::INFO) {
					$this->errorType = FlashMessage::OK;
					$this->header = 'No errors were found';
					$this->preText = 'Bootstrap Package has been configured correctly and works as expected.<br />';
				}
				break;
		}
	}


	/**
	 * Checks if ext:themes is loaded and throws an additional Warning
	 *
	 * @return    string
	 */
	public function checkIfThemesIsLoaded(&$params, &$tsObj) {

		if (!ExtensionManagementUtility::isLoaded('themes')) {
			$this->setErrorLevel('ok');
		} else {
			$this->setErrorLevel('warning');
			$this->problems[] = "The backend skin functionality from the Bootstrap Package is disabled by default if ext:themes is loaded.";
		}
		if (count($this->problems) > 0) {
			$message = '<ul>';
			foreach ($this->problems as $problem) {
				$message .= '<li>' . $problem . '</li>';
			}
			$message .= '</ul>';
		}
		$message = $this->preText . $message;
		$flashMessage = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessage', $message, $this->header, $this->errorType);
		$out = $flashMessage->render();
		return $out;
	}

}
