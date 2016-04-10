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
    
    function rowCount()
    {
        return $this->statement->rowCount();
    }
    
    function fetchAll($className = null)
    {
        return $className ? $this->fetchObjects($className) : $this->fetchAssocArrays();
    }
    
    function fetchAssocArrays()
    {
        return $this->statement->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    function fetchObjects($className)
    {
        return $this->statement->fetchAll(\PDO::FETCH_CLASS, $className);
    }
}
