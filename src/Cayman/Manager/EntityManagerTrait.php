<?php
/**
 * File for Entity Manager trait
 */

namespace Cayman\Manager;

use Cayman\ExceptionManagerUndefined;

/**
 * Trait for Entity Manager
 *
 */
trait EntityManagerTrait
{
    
    /**
     * Entity Manager object
     * @var EntityManager
     */
    private $entityManager;
    
    /**
     * Set Entity Manager
     * @param EntityManager $entityManager
     * @return void
     */
    function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * Get Entity Manager
     * @return EntityManager
     */
    function getEntityManager()
    {
        if (empty($this->entityManager)) {
            $manager = $this->getManager('entity');//try to load it using app
            if (empty($manager)) {
                throw new ExceptionManagerUndefined('Entity manager undefined');
            }
        }
        
        return $this->entityManager;
    }
    
}
