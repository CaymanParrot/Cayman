<?php
/**
 * File for Database Schema Manager interface
 */

namespace Cayman\Manager;

use Cayman\Manager\DbSchemaManager\Table;

/**
 * Interface for Database Schema Manager
 */
interface DbSchemaManager
{
    /**
     * Set schema name
     * @param string $name
     * @return void
     */
    function dbSetSchemaName($name);
    
    /**
     * Get schema name
     * @return string
     */
    function dbGetSchemaName();
    
    /**
     * Get tables
     * @return Table[]
     */
    function dbGetTables();
    
    /**
     * Create table
     * 
     * @param Table $table
     * @return bool
     */
    function dbCreateTable(Table $table);
    
}
