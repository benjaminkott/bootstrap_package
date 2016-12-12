<?php

$TYPO3_VERSION = \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(
    \TYPO3\CMS\Core\Utility\VersionNumberUtility::getNumericTypo3Version()
);
if ($TYPO3_VERSION < 8005000) {
    return [
        'TYPO3\\CMS\\Frontend\\DataProcessing\\MenuProcessor' => \BK2K\BootstrapPackage\DataProcessing\MenuProcessor::class
    ];
}
return [];
