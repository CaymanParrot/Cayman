<?php
/**
 * File for PostgreSQL 9.5 Database Manager
 */

namespace Cayman\Manager\DbSchemaManager;

use Cayman\Manager;
use Cayman\Manager\DbSchemaManager;

/**
 * Class for PostgreSQL Database Manager
 * 
 * @see http://www.postgresql.org/docs/9.5/static/sql-createtable.html
 *
 */
class PostgreSql extends Manager implements DbSchemaManager
{
    
    /**
     * Create table
     * 
     * @param Table $table
     * @return bool
     */
    function dbCreateTable(Table $table)
    {
        //TODO: implement
    }
}
