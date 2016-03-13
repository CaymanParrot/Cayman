<?php
/**
 * File for Queue Manager trait
 */

namespace Cayman\Manager;

use Cayman\ExceptionManagerUndefined;

/**
 * Trait for Queue Manager
 *
 */
trait QueueManagerTrait
{
    
    /**
     * Queue Manager object
     * @var QueueManager
     */
    private $queueManager;
    
    /**
     * Set Queue Manager
     * @param QueueManager $queueManager
     * @return void
     */
    function setQueueManager(QueueManager $queueManager)
    {
        $this->queueManager = $queueManager;
    }
    
    /**
     * Get Queue Manager
     * @return QueueManager
     */
    function getQueueManager()
    {
        if (empty($this->queueManager)) {
            $manager = $this->getManager('queue');//try to load it using app
            if (empty($manager)) {
                throw new ExceptionManagerUndefined('Queue manager undefined');
            }
        }
        
        return $this->queueManager;
    }
    
}
