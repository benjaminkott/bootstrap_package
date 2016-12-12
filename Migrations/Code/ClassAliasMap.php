<?php

if (!class_exists('TYPO3\CMS\Frontend\DataProcessing\MenuProcessor')) {
    return [
        'TYPO3\\CMS\\Frontend\\DataProcessing\\MenuProcessor' => \BK2K\BootstrapPackage\DataProcessing\MenuProcessor::class
    ];
}
return [];
