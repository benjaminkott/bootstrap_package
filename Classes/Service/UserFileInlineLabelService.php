<?php
namespace BK2K\BootstrapPackage\Service;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Resource\Exception\InvalidUidException;
use TYPO3\CMS\Core\Resource\Index\MetaDataRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * User file inline label service
 */
class UserFileInlineLabelService
{
    /**
     * Get the user function label for the file_reference table
     *
     * @param array $params
     * @return void
     */
    public function getInlineLabel(array &$params)
    {
        $sysFileFields = isset($params['options']['sys_file']) && is_array($params['options']['sys_file'])
            ? $params['options']['sys_file']
            : array();

        if (empty($sysFileFields)) {
            // Nothing to do
            $params['title'] = $params['row']['uid'];
            return;
        }

        $addition = '';
        if ($params['row']['tablenames'] === 'sys_file_reference' && $params['row']['fieldname'] === 'alternativefile') {
            $addition = $params['row']['alternativetag'];
            if (!empty($addition)) {
                if (is_array($addition)) {
                    $adds = '';
                    foreach ($addition as $k => $field) {
                        $adds .= LocalizationUtility::translate('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.breakpoints.' . trim($field), 'lang') . ' ';
                    }
                    $addition = $adds;
                } else {
                    $addition = LocalizationUtility::translate('LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.breakpoints.' . trim($addition), 'lang');
                }
                $addition = ' <strong>(' . $addition . ')</strong>';
            }
        }

        // In case of a group field uid_local has the table_uid|label syntax
        $tableAndUid = array_shift(GeneralUtility::trimExplode('|', $params['row']['uid_local'], true, 2));
        $fileInfo = BackendUtility::splitTable_Uid($tableAndUid);
        $fileRecord = BackendUtility::getRecord($fileInfo[0], $fileInfo[1]);

        // Configuration
        $title = array();
        foreach ($sysFileFields as $field) {
            $value = '';
            if ($field === 'title') {
                if (isset($params['row']['title'])) {
                    $fullTitle = $params['row']['title'];
                } else {
                    try {
                        $metaDataRepository = GeneralUtility::makeInstance(MetaDataRepository::class);
                        $metaData = $metaDataRepository->findByFileUid($fileRecord['uid']);
                        $fullTitle = $metaData['title'];
                    } catch (InvalidUidException $e) {
                        /**
                         * We just catch the exception here
                         * Reasoning: There is nothing an editor or even admin could do
                         */
                        $fullTitle = '';
                    }
                }

                $value = BackendUtility::getRecordTitlePrep(htmlspecialchars($fullTitle));
            } else {
                if (isset($params['row'][$field])) {
                    $value = htmlspecialchars($params['row'][$field]);
                } elseif (isset($fileRecord[$field])) {
                    $value = BackendUtility::getRecordTitlePrep($fileRecord[$field]);
                }
            }
            if ((string)$value === '') {
                continue;
            }
            $labelText = LocalizationUtility::translate('LLL:EXT:lang/locallang_tca.xlf:sys_file.' . $field, 'lang');
            $title[] = '<dt>' . htmlspecialchars($labelText) . '</dt>' . '<dd>' . $value . $addition . '</dd>';
        }

        $params['title'] = '<dl>' . implode('', $title) . '</dl>';
    }
}
