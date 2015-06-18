<?php
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Extbase\Utility\ArrayUtility;

function user_getTemplateFromName($content,$conf) {

	$basename = $content;

	if ($conf['paths'][0] === '<') {
		$key = trim(substr($conf['paths'], 1));
		$cF = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\TypoScript\\Parser\\TypoScriptParser');
		list($name, $conf['paths.']) = $cF->getVal($key, $GLOBALS['TSFE']->tmpl->setup);
	}

	$paths = ArrayUtility::sortArrayWithIntegerKeys($conf['paths.']);
	$paths = array_reverse($paths, TRUE);

	foreach ($paths as $path) {
		// why does it have to be relative?
		$test_file = PathUtility::getRelativePathTo(GeneralUtility::getFileAbsFileName($path)).$basename;
		if(is_file($test_file))
			return $test_file;
		if(is_file($test_file.'.html'))
			return $test_file.'.html';
	}
	return $content;
}
