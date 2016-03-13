<?php
/**
 * File for Entity Manager interface
 */

namespace Cayman\Manager;

/**
 * Interface for Entity Manager
 */
interface EntityManager
{
    
    /**
     * Create entity
     * 
     * @param string $entity
     * @return Entity
     */
    function entityCreate($entity);
    
    /**
     * Retrieve entity
     * 
     * @param string $entity
     * @return Entity
     */
    function entityRetrieve($entity);

}
