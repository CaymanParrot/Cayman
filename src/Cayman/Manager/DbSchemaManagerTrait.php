<?php
/**
 * File for Db Schema Manager trait
 */

namespace Cayman\Manager;

use Cayman\ExceptionManagerUndefined;

/**
 * Trait for Db Schema Manager
 *
 */
trait DbSchemaManagerTrait
{
    
    /**
     * Database schema manager object
     * @var DbSchemaManager
     */
    private $dbSchemaManager;
    
    /**
     * Set database schema manager
     * @param DbSchemaManager $dbSchemaManager
     * @return void
     */
    function setDbSchemaManager(DbSchemaManager $dbSchemaManager)
    {
        $this->dbSchemaManager = $dbSchemaManager;
    }
    
    /**
     * Get database schema manager
     * @return DbSchemaManager
     */
    function getDbSchemaManager()
    {
        if (empty($this->dbSchemaManager)) {
            $manager = $this->getManager('dbschema');//try to load it using app
            if (empty($manager)) {
                throw new ExceptionManagerUndefined('Database schema manager undefined');
            }
        }
        
        return $this->dbSchemaManager;
    }
    
}
