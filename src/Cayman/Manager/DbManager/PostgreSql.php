<?php
/**
 * File for PostgreSQL 9.5 Database Manager
 */

namespace Cayman\Manager\DbManager;

use Cayman\Application;
use Cayman\Settings;
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
    use Manager\PdoTrait;
    
    /**
     * Begin transaction
     * @return bool
     */
    function dbBeginTransaction()
    {
        return $this->getPdo()->beginTransaction();
    }
    
    /**
     * Commit transaction
     * @return bool
     */
    function dbCommitTransaction()
    {
        return $this->getPdo()->commit();
    }
    
    /**
     * Rollback transaction
     * @return bool
     */
    function dbRollbackTransaction()
    {
        return $this->getPdo()->rollBack();
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
            $statement = $this->getPdo()->query($sql);
        } else {
            $statement = $this->getPdo()->prepare($sql);
            $statement->execute($params);
        }
        
        return $statement;
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
     * Execute query and return records as instance of class given
     * 
     * @param string $sql
     * @param array  $params
     * @param string $className
     * @return int
     */
    function dbFetchAllClasses($sql, array $params, $className)
    {
        $statement = $this->dbStatement($sql, $params);
        $rows      = $statement->fetchAll(\PDO::FETCH_CLASS, $className);
        
        return $rows;
    }
    
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
    function dbInsert($tableName, array $data = [], $returnFieldNames = '*')
    {
        if (empty($data)) {//no data provided, use default values for all fields
            $sql = 'INSERT INTO ' .$tableName
                . ' DEFAULT VALUES';
            $parameters = [];
        } else {
            $fields       = array_keys($data);
            $fieldList    = "'" . implode("', '", $fields) . "'";
            $placeHolders = str_repeat(',?', count($fields));
            $placeHolders = substr($placeHolders, 1);// remove the first char ','
            $parameters   = array_values($data);
            $sql = 'INSERT INTO ' . $tableName . '(' . $fieldList . ')'
                . ' VALUES (' . $placeHolders . ')';
        }
        
        if (empty($returnFieldNames)) {
            $qry = $this->dbStatement($sql, $parameters);
            $result = [];
        } else {
            $sql .= ' RETURNING ' . $returnFieldNames;
            $qry = $this->dbStatement($sql, $parameters);
            $result = $qry->fetch(\PDO::FETCH_ASSOC);
        }
        
        return $result;
    }
    
    /**
     * Update record
     * 
     * @param string $tableName
     * @param array  $data
     * @param string $where
     * @param array  $whereParams
     * @return bool
     */
    function dbUpdate($tableName, array $data, $where, array $whereParams = [])
    {
        $allParameters = [];
        $fieldAssignments = [];
        foreach($data as $field => $value) {
            $fieldAssignments[] = $field . ' = ?';
            $allParameters[]    = $value;
        }
        $fieldAssignmentList = implode(', ', $fieldAssignments);
        
        foreach($whereParams as $value) {
            $allParameters[] = $value;
        }
        
        $sql = 'UPDATE ' . $tableName
            . ' SET ' . $fieldAssignmentList
            . ' WHERE ' . $where;
        
        $qry = $this->dbStatement($sql, $allParameters);
        
        return $qry;
    }
    
    /**
     * Delete record
     * 
     * @param string $tableName
     * @param string $where
     * @param array  $whereParams
     * @return bool
     */
    function dbDelete($tableName, $where, array $whereParams = [])
    {
        $sql = 'DELETE ' . $tableName
            . ' WHERE ' . $where;
        $qry = $this->dbStatement($sql, $whereParams);
        
        return $qry;
    }
}
