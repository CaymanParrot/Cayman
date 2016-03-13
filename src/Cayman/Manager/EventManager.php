<?php
/**
 * File for Event Manager interface
 */

namespace Cayman\Manager;

use Cayman\Manager\EventManager\EventListener;
use Cayman\Manager\EventManager\EventContext;

/**
 * Interface for Event Manager
 */
interface EventManager
{
    
    /**
     * Register listener to event
     * @param string        $eventName
     * @param EventListener $listener
     * @return int Last key generated
     */
    function eventRegister($eventName, EventListener $listener);
    
    /**
     * UnRegister listener from event
     * @param string $eventName
     * @param int    $id
     * @return void
     */
    function eventUnRegister($eventName, $id);
    
    /**
     * Broadcast event
     * @param string       $eventName
     * @param EventContext $context
     * @return void
     */
    function eventBroadcast($eventName, EventContext $context);

}
