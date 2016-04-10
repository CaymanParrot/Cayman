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
     * Schema name
     * @var string
     */
    protected $schemaName;
    
    /**
     * Set schema name
     * @param string $name
     * @return void
     */
    function dbSetSchemaName($name)
    {
        $this->schemaName = $name;
    }
    
    /**
     * Get schema name
     * @return string
     */
    function dbGetSchemaName()
    {
        return $this->schemaName;
    }
    
    /**
     * Get tables
     * @return Table[]
     */
    function dbGetTables()
    {
        $sql = <<<SQL
select *
from information_schema.tables t
where t.table_schema = ?
--  and t.table_catalog = '[dbname]'
;
SQL;
        $params = [
            $this->dbGetSchemaName(),
        ];
        $tables = $this->getDbManager()->dbFetchAllClasses($sql, $params, Table::class);
        return $tables;
    }
    
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
