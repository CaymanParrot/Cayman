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
     * Execute query and return records as instance of class given
     * 
     * @param string $sql
     * @param array  $params
     * @param string $className
     * @return int
     */
    function dbFetchAllClasses($sql, array $params, $className);
    
    /**
     * Insert record
     * 
     * @see http://www.postgresql.org/docs/9.5/static/sql-insert.html
     * 
     * @param string $tableName
     * @param array  $data
     * @param string $returnFieldNames
     * @return array
     */
    function dbInsert($tableName, array $data = [], $returnFieldNames = '*');
    
    /**
     * Update record
     * 
     * @param string $tableName
     * @param array  $data
     * @param string $where
     * @param array  $whereParams
     * @return bool
     */
    function dbUpdate($tableName, array $data, $where, array $whereParams = []);
    
    /**
     * Delete record
     * 
     * @param string $tableName
     * @param string $where
     * @param array  $whereParams
     * @return bool
     */
    function dbDelete($tableName, $where, array $whereParams = []);
    
}
