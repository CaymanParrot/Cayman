<?php
/**
 * File for Simple Event Manager class
 */

namespace Cayman\Manager\EventManager;

use Cayman\Exception;
use Cayman\Manager;
use Cayman\Manager\EventManager;

/**
 * Class for Simple Event Manager
 *
 */
class SimpleEventManager extends Manager implements EventManager
{
    /**
     * Events and listeners
     * @var array
     */
    private $events = [];
    
    /**
     * Listen to event
     * @param string        $eventName
     * @param EventListener $listener
     * @return int Last ID generated
     */
    function eventRegister($eventName, EventListener $listener)
    {
        if (empty($this->events[$eventName])) {
            $this->events[$eventName] = [];
        }
        $this->events[$eventName][] = $listener;
        
        $ids    = array_keys($this->events[$eventName]);
        $lastId = array_pop($ids);
        
        return $lastId;
    }
    
    /**
     * UnRegister listener from event
     * @param string $eventName
     * @param int    $id
     * @return void
     */
    function eventUnRegister($eventName, $id)
    {
        if (isset($this->events[$eventName][$id])){
            unset($this->events[$eventName][$id]);
        }
    }
    
    /**
     * Broadcast event
     * @param string       $eventName
     * @param EventContext $context
     * @return void
     */
    function eventBroadcast($eventName, EventContext $context)
    {
        if (empty($this->events[$eventName])) {
            throw new Exception('Event undefined');
        }
        foreach($this->events[$eventName] as $listener) {
            $stop = $listener->eventListen($eventName, $context);
            if ($stop) {
                break;
            }
        }
    }
}
