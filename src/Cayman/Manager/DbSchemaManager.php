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
     * Create table
     * 
     * @param Table $table
     * @return bool
     */
    function dbCreateTable(Table $table);
    
}
