<?php
/**
 * File for PostgreSQL 9.5 Entity Manager
 */

namespace Cayman\Manager\DbManager;

use Cayman\Manager;
use Cayman\Manager\EntityManager;

/**
 * Class for PostgreSQL Database Entity Manager
 *
 */
class PostgreSql extends Manager implements EntityManager
{
    
    /**
     * Create entity
     * 
     * @param string $entity
     * @return Entity
     */
    function entityCreate($entity)
    {
        //TODO: implement
    }
    
    /**
     * Retrieve entity
     * 
     * @param string $entity
     * @return Entity
     */
    function entityRetrieve($entity)
    {
        //TODO: implement
    }
}
