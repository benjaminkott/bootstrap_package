<?php
namespace BK2K\BootstrapPackage\ViewHelpers;

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
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * @author Benjamin Kott <info@bk2k.info>
 */
class FalViewHelper extends AbstractViewHelper {

	/**
	 * @var \TYPO3\CMS\Core\Resource\FileRepository
	 */
	protected $fileRepository;

	/**
	 * @param array $data
	 * @param string $as
	 * @param string $table
	 * @param string $field
	 *
	 * @return string
	 */
	public function render($data, $as = 'items', $table = 'tt_content', $field = 'image') {

		if (is_array($data) && $data['uid'] && $data[$field]) {
			$this->fileRepository = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
			$items = $this->fileRepository->findByRelation($table, $field, $data['uid']);
			$localizedId = NULL;
			if (isset($data['_LOCALIZED_UID'])) {
				$localizedId = $data['_LOCALIZED_UID'];
			} elseif (isset($data['_PAGES_OVERLAY_UID'])) {
				$localizedId = $data['_PAGES_OVERLAY_UID'];
			}
			$isTableLocalizable = (
				!empty($GLOBALS['TCA'][$table]['ctrl']['languageField'])
				&& !empty($GLOBALS['TCA'][$table]['ctrl']['transOrigPointerField'])
			);
			if ($isTableLocalizable && $localizedId !== NULL) {
				$items = $this->fileRepository->findByRelation($table, $field, $localizedId);
			}
		} else {
			$items = NULL;
		}
		$this->templateVariableContainer->add($as, $items);
		$content = $this->renderChildren();
		$this->templateVariableContainer->remove($as);

		return $content;
	}

}
