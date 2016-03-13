<?php
/**
 * File for Redis Queue Manager class
 */

namespace Cayman\Manager\QueueManager;

use Cayman\Manager;
use Cayman\Manager\QueueManager;

/**
 * Class for Redis Queue Manager
 *
 */
class RedisQueue extends Manager implements QueueManager
{
    use Manager\RedisTrait;
    
    /**
     * Append work to one queue
     * @param string  $workName
     * @param Message $message
     * @return bool
     */
    function queuePublish($workName, Message $message)
    {
        //TODO: implement
    }
    
    /**
     * Append work to all queues
     * @param string  $workName
     * @param Message $message
     * @return int Number of clients received the message
     */
    function queuePublishAll($workName, Message $message)
    {
        //TODO: implement
    }
    
    /**
     * Register callback for work
     * @param string $workName
     * @param callable $callable
     */
    function queueSubscribe($workName, callable $callable)
    {
        //TODO: implement
    }
    
    /**
     * Register callback for work
     * @param string $workName
     * @param callable $callable
     */
    function queueUnSubscribe($workName, callable $callable)
    {
        //TODO: implement
    }

    /**
     * Remove work
     * @param string $workName
     * @param string $id
     */
    function queueUnPublish($workName, $id)
    {
        //TODO: implement
    }
}
