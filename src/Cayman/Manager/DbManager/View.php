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
    use \Cayman\Library\ObjectHydratorTrait;
    use \Cayman\Library\ObjectDeHydratorTrait;
    
    /**
     * Get name e.g. 'tbl_user'
     * @return string
     */
    abstract function getName();
    
    /**
     * Get schema name e.g. 'public'
     * @return string
     */
    function getSchemaName()
    {
        return 'public';
    }
    
    /**
     * Get fully qualified name e.g. '"public"."tbl_user"'
     * @return string
     */
    function getFullName()
    {
        return sprintf('"%s"."%s"', $this->getSchemaName(), $this->getName());
    }
    
    /**
     * Get schema name e.g. 'SELECT * FROM "public"."tbl_user"'
     * @return string
     */
    function getSql()
    {
        return 'SELECT * FROM ' . $this->getFullName();
    }
    
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
    function getRowClassName()
    {
        $result = null;
        
        $class = get_class($this);
        if (substr($class, -5) == 'Table') {
            $result = substr($class, 0, -5) . 'Row';
        }
        
        return $result;
    }
    
    /**
     * Primary key fields
     * @var array
     */
    protected $primaryKey = [ 'id' ];
    
    /**
     * Get primary key fields
     * @var array
     */
    function getPrimaryKey()
    {
        return $this->primaryKey;
    }
    
}
