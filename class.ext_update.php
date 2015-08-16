<?php

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

use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Update class for bootstrap package
 * + Migrates backend layout prefix in database fields 'backend_layout' and 'backend_layout_next_level' of table 'pages' from 'bootstrap_package__' to 'pagets__'
 *
 * @author Philipp Roski <philipp.roski@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class ext_update
{

    const OLD_BACKEND_LAYOUT_PREFIX = 'bootstrap_package__';
    const NEW_BACKEND_LAYOUT_PREFIX = 'pagets__';

    /**
     * Main update function called by the extension manager.
     *
     * @return string
     */
    public function main()
    {
        $rows = $this->getDatabaseConnection()->exec_SELECTgetRows(
            'uid, backend_layout, backend_layout_next_level',
            'pages',
            'backend_layout LIKE \'' . self::OLD_BACKEND_LAYOUT_PREFIX . '%\' OR backend_layout_next_level LIKE \'' . self::OLD_BACKEND_LAYOUT_PREFIX . '%\''
        );
        foreach ($rows as $row) {
            if (strpos($row['backend_layout'], self::OLD_BACKEND_LAYOUT_PREFIX) !== false) {
                $fieldsToUpdate['backend_layout'] = substr_replace(
                    $row['backend_layout'],
                    self::NEW_BACKEND_LAYOUT_PREFIX,
                    0,
                    strlen(self::OLD_BACKEND_LAYOUT_PREFIX)
                );
            }
            if (strpos($row['backend_layout_next_level'], self::OLD_BACKEND_LAYOUT_PREFIX) !== false) {
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
    public function access($what = 'all')
    {
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
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }

}
