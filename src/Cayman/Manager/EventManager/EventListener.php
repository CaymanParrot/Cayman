<?php

/**
 * File for Event Listener interface
 */

namespace Cayman\Manager\EventManager;

/**
 * Interface for Event Listener
 *
 */
interface EventListener
{
    /**
     * Listen to event
     * @param string       $eventName
     * @param EventContext $context
     * @return bool        Flag to stop propagation or not
     */
    function eventListen($eventName, EventContext $context);
}
