<?php
/**
 * File for View class
 */

namespace Cayman\Manager\DbManager;

/**
 * Class for View
 *
 */
abstract class View
{
    /**
     * Get name e.g. 'tbl_user'
     * @return string
     */
    abstract function getName();
    
    /**
     * Get schema name e.g. 'public'
     * @return string
     */
    abstract function getSchemaName();
    
    /**
     * Get SQL statement
     * @return string
     */
    abstract function getSql();
    
    /**
     * Get parameters
     * @return array
     */
    function getParameters()
    {
        return [];
    }

    /**
     * Class name of records to be returned and hydrated
     * Associative arrays will be returned, if class name is not given
     * @return string
     */
    function getClassName()
    {
        return null;
    }
}
