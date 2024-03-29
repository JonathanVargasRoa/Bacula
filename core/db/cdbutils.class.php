<?php

/**
 * Copyright (C) 2010-2022 Davide Franco
 * 
 * This file is part of Bacula-Web.
 * 
 * Bacula-Web is free software: you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation, either version 2 of the License, or 
 * (at your option) any later version.
 * 
 * Bacula-Web is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
 * See the GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License along with Bacula-Web. If not, see 
 * <https://www.gnu.org/licenses/>.
 */

class CDBUtils
{
    private static $result_count;

    private function __construct()
    {
    }

    // ==================================================================================
    // Function: 	getConnectionStatus()
    // Parameters:	$PDO_connection (valid pdo connection)
    // Return:	true if the PDO connection is valid or false
    // ==================================================================================

    public static function getConnectionStatus($PDO_connection)
    {
        // If MySQL of postGreSQL
        if (CDB::getDriverName() != 'sqlite') {
            return $PDO_connection->getAttribute(PDO::ATTR_CONNECTION_STATUS);
        } else {
            return 'N/A';
        }
    }
    
    public function countResult()
    {
        return self::$result_count;
    }

    public static function runQuery($query, $db_link)
    {
        $statment    = $db_link->prepare($query);

        if ($statment == false) {
            throw new PDOException("Failed to prepare PDOStatment <br />$query");
        }
            
        $result     = $statment->execute();

        if (is_null($result)) {
            throw new PDOException("Failed to execute PDOStatment <br />$query");
        }
    
        return $statment ;
    }
}
