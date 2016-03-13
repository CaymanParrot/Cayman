<?php
/**
 * File for Event Manager trait
 */

namespace Cayman\Manager;

use Cayman\ExceptionManagerUndefined;

/**
 * Trait for Event Manager
 *
 */
trait EventManagerTrait
{
    /**
     * Event Manager object
     * @var EventManager
     */
    private $eventManager;
    
    /**
     * Set Event Manager
     * @param EventManager $eventManager
     * @return void
     */
    function setEventManager(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }
    
    /**
     * Get Event Manager
     * @return EventManager
     */
    function getEventManager()
    {
        if (empty($this->eventManager)) {
            $manager = $this->getManager('event');//try to load it using app
            if (empty($manager)) {
                throw new ExceptionManagerUndefined('Event manager undefined');
            }
        }
        
        return $this->eventManager;
    }
    
}
