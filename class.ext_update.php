<?php

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

use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Update class for bootstrap package
 * + Migrates backend layout prefix in database fields 'backend_layout' and 'backend_layout_next_level' of table 'pages' from 'bootstrap_package__' to 'pagets__'
 *
 * @author Philipp Roski <philipp.roski@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class ext_update {

    const OLD_BACKEND_LAYOUT_PREFIX = 'bootstrap_package__';
    const NEW_BACKEND_LAYOUT_PREFIX = 'pagets__';

    /**
     * Main update function called by the extension manager.
     *
     * @return string
     */
    public function main() {
        $rows = $this->getDatabaseConnection()->exec_SELECTgetRows(
            'uid, backend_layout, backend_layout_next_level',
            'pages',
            'backend_layout LIKE \'' . self::OLD_BACKEND_LAYOUT_PREFIX . '%\' OR backend_layout_next_level LIKE \'' . self::OLD_BACKEND_LAYOUT_PREFIX . '%\''
        );
        foreach ($rows as $row) {
            if (strpos($row['backend_layout'], self::OLD_BACKEND_LAYOUT_PREFIX) !== FALSE) {
                $fieldsToUpdate['backend_layout'] = substr_replace(
                    $row['backend_layout'],
                    self::NEW_BACKEND_LAYOUT_PREFIX,
                    0,
                    strlen(self::OLD_BACKEND_LAYOUT_PREFIX)
                );
            }
            if (strpos($row['backend_layout_next_level'], self::OLD_BACKEND_LAYOUT_PREFIX) !== FALSE) {
                $fieldsToUpdate['backend_layout_next_level'] = substr_replace(
                    $row['backend_layout_next_level'],
                    self::NEW_BACKEND_LAYOUT_PREFIX,
                    0,
                    strlen(self::OLD_BACKEND_LAYOUT_PREFIX)
                );
            }
            $this->getDatabaseConnection()->exec_UPDATEquery(
                'pages',
                'uid = ' . (int)$row['uid'],
                $fieldsToUpdate
            );
            unset($fieldsToUpdate);
        }
        /* @var $flashMessage FlashMessage */
        $flashMessage = GeneralUtility::makeInstance(
            'TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
            'All pages with backend layouts successfully updated',
            'Migration completed',
            FlashMessage::OK
        );
        return $flashMessage->render();
    }

    /**
     * Checks if there are any rows to update and the update menue entry should be shown. This function is called by the extension manager.
     *
     * @param string $what What should be updated
     * @return bool TRUE if there are any rows to update; FALSE otherwise.
     */
    public function access($what = 'all') {
        $row = $this->getDatabaseConnection()->exec_SELECTgetSingleRow(
            'count(*) AS count',
            'pages',
            'backend_layout LIKE \'' . self::OLD_BACKEND_LAYOUT_PREFIX . '%\' OR backend_layout_next_level LIKE \'' . self::OLD_BACKEND_LAYOUT_PREFIX . '%\''
        );
        return $row['count'] > 0;
    }

    /**
     * Get DatabaseConnection
     *
     * @return DatabaseConnection
     */
    protected function getDatabaseConnection() {
        return $GLOBALS['TYPO3_DB'];
    }

}
