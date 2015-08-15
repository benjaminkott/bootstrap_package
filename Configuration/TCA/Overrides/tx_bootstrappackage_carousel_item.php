<?php

/***************
 * Compatability
 */
if (\TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version) < 7003000) {

    /**
     * Append t3editor to bodytext in type HTML
     */
    $showitemConfig = $GLOBALS['TCA']['tx_bootstrappackage_carousel_item']['types']['html']['showitem'];
    $newFormat = 'bodytext;LLL:EXT:cms/locallang_ttc.xlf:bodytext.ALT.html_formlabel';
    $oldFormat = 'bodytext;LLL:EXT:cms/locallang_ttc.xlf:bodytext.ALT.html_formlabel;;nowrap:wizards[t3editor]';
    $GLOBALS['TCA']['tx_bootstrappackage_carousel_item']['types']['html']['showitem'] = str_replace($newFormat, $oldFormat, $showitemConfig);
    unset($showitemConfig, $newFormat, $oldFormat);

}
