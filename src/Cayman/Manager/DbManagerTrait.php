<?php
/**
 * File for Db Manager trait
 */

namespace Cayman\Manager;

use Cayman\ExceptionManagerUndefined;

/**
 * Trait for Db Manager
 *
 */
trait DbManagerTrait
{
    
    /**
     * Database manager object
     * @var DbManager
     */
    private $dbManager;
    
    /**
     * Set database manager
     * @param DbManager $dbManager
     * @return void
     */
    function setDbManager(DbManager $dbManager)
    {
        $this->dbManager = $dbManager;
    }
    
    /**
     * Get database manager
     * @return DbManager
     */
    function getDbManager()
    {
        if (empty($this->dbManager)) {
            $manager = $this->getManager('db');//try to load it using app
            if (empty($manager)) {
                throw new ExceptionManagerUndefined('Database manager undefined');
            }
        }
        
        return $this->dbManager;
    }
    
}
