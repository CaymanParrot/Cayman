<?php
/**
 * File for output class of statement function of db manager
 */

namespace Cayman\Manager\DbManager;

/**
 * Class for output of statement function of db manager
 *
 */
class OutputForStatement extends OutputCommon
{
    /**
     * PDO statement
     * @var \PDOStatement
     */
    public $statement;
    
    /**
     * Get row count affected by statement
     * @return int
     */
    function rowCount()
    {
        return $this->statement->rowCount();
    }
    
    /**
     * Fetch records as array of associative arrays
     * or array of objects (if class name given)
     * @param string $className
     * @return array
     */
    function fetchAll($className = null)
    {
        return $className ? $this->fetchObjects($className) : $this->fetchAssocArrays();
    }
    
    /**
     * Fetch records as associative arrays
     * @return array
     */
    function fetchAssocArrays()
    {
        return $this->statement->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    /**
     * Fetch records as objects
     * @param string $className
     * @return array
     */
    function fetchObjects($className)
    {
        return $this->statement->fetchAll(\PDO::FETCH_CLASS, $className);
    }
}
