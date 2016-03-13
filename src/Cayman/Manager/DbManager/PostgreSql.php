<?php
/**
 * File for PostgreSQL 9.5 Database Manager
 */

namespace Cayman\Manager\DbManager;

use Cayman\Exception;
use Cayman\Manager;
use Cayman\Manager\DbManager;

/**
 * Class for PostgreSQL Database Manager
 * 
 * @see http://www.postgresql.org/docs/9.5/static/sql-createtable.html
 *
 */
class PostgreSql extends Manager implements DbManager
{
    use Manager\PdoManagerTrait;
    
    /**
     * Begin transaction
     * @return bool
     */
    function dbBeginTransaction()
    {
        return $this->getPdoManager()->beginTransaction();
    }
    
    /**
     * Commit transaction
     * @return bool
     */
    function dbCommitTransaction()
    {
        return $this->getPdoManager()->commit();
    }
    
    /**
     * Rollback transaction
     * @return bool
     */
    function dbRollbackTransaction()
    {
        return $this->getPdoManager()->rollBack();
    }
    
    /**
     * Execute query and return statement object
     * 
     * @param string $sql
     * @param array  $params
     * @return array
     */
    function dbStatement($sql, array $params = [])
    {
        if (empty($params)) {
            $statement = $this->getPdoManager()->query($sql);
        } else {
            $statement = $this->getPdoManager()->prepare($sql);
            $statement->execute($params);
        }
        $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);
        
        return $rows;
    }
    
    /**
     * Execute query and return records
     * 
     * @param string $sql
     * @param array  $params
     * @return int
     */
    function dbFetchAllRows($sql, array $params = [])
    {
        $statement = $this->dbStatement($sql, $params);
        $rows      = $statement->fetchAll(\PDO::FETCH_ASSOC);
        
        return $rows;
    }
    
    /**
     * Insert record
     * 
     * @param string $table
     * @param array  $data
     * @return int
     */
    function dbInsert($table, array $data)
    {
        //TODO: implement
    }
    
    /**
     * Update record
     * 
     * @param string $table
     * @param array  $data
     * @param string $where
     * @param array  $params
     * @return int
     */
    function dbUpdate($table, array $data, $where, array $params = [])
    {
        //TODO: implement
    }
    
    /**
     * Delete record
     * 
     * @param string $table
     * @param string $where
     * @param array  $params
     * @return int
     */
    function dbDelete($table, $where, array $params = [])
    {
        //TODO: implement
    }
}
