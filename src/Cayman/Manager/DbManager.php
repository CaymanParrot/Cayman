<?php
/**
 * File for Database Manager interface
 */

namespace Cayman\Manager;

/**
 * Interface for Database Manager
 */
interface DbManager
{
    /**
     * Begin transaction
     * @return bool
     */
    function dbBeginTransaction();
    
    /**
     * Commit transaction
     * @return bool
     */
    function dbCommitTransaction();
    
    /**
     * Rollback transaction
     * @return bool
     */
    function dbRollbackTransaction();
    
    /**
     * Execute query and return statement object
     * 
     * @param string $sql
     * @param array  $params
     * @return \PDOStatement
     */
    function dbStatement($sql, array $params = []);
    
    /**
     * Execute query and return records
     * 
     * @param string $sql
     * @param array  $params
     * @return int
     */
    function dbFetchAllRows($sql, array $params = []);

    /**
     * Insert record
     * 
     * @param string $table
     * @param array  $data
     * @return int
     */
    function dbInsert($table, array $data);
    
    /**
     * Update record
     * 
     * @param string $table
     * @param array  $data
     * @param string $where
     * @param array  $params
     * @return int
     */
    function dbUpdate($table, array $data, $where, array $params = []);
    
    /**
     * Delete record
     * 
     * @param string $table
     * @param string $where
     * @param array  $params
     * @return int
     */
    function dbDelete($table, $where, array $params = []);
    
}
