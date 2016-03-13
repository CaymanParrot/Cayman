<?php
/**
 * File for Queue Manager interface
 */

namespace Cayman\Manager;

use Cayman\Manager\QueueManager\Message;

/**
 * Interface for Queue Manager
 */
interface QueueManager
{

    /**
     * Append work to one queue
     * @param string  $workName
     * @param Message $message
     * @return bool
     */
    function queuePublish($workName, Message $message);
    
    /**
     * Append work to all queues
     * @param string  $workName
     * @param Message $message
     * @return int Number of clients received the message
     */
    function queuePublishAll($workName, Message $message);
    
    /**
     * Register callback for work
     * @param string $workName
     * @param callable $callable
     */
    function queueSubscribe($workName, callable $callable);
    
    /**
     * Register callback for work
     * @param string $workName
     * @param callable $callable
     */
    function queueUnSubscribe($workName, callable $callable);

    /**
     * Remove work
     * @param string $workName
     * @param string $id
     */
    function queueUnPublish($workName, $id);
    
}
