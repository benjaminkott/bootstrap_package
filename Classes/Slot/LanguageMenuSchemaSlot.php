<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Slot;

/**
 * Adds additional SQL fields for dynamic language menu generation
 */
class LanguageMenuSchemaSlot
{
    /**
     * @param array $sqlString
     * @return array
     */
    public function registerLanguageMenuFields($sql)
    {
        $sql[] = '
            CREATE TABLE sys_language (
                nav_title varchar(255) DEFAULT \'\' NOT NULL,
                locale varchar(20) DEFAULT \'\' NOT NULL,
                hreflang varchar(20) DEFAULT \'\' NOT NULL,
                direction varchar(3) DEFAULT \'\' NOT NULL,
            );
        ';

        return [
            $sql
        ];
    }
}
