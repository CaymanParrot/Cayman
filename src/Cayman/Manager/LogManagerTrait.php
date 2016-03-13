<?php
/**
 * File for Log Manager trait
 */

namespace Cayman\Manager;

/**
 * Trait for Log Manager
 *
 */
trait LogManagerTrait
{
    
    /**
     * Log Manager object
     * @var LogManager
     */
    private $logManager;
    
    /**
     * Set Log Manager
     * @param LogManager $logManager
     * @return void
     */
    function setLogManager(LogManager $logManager)
    {
        $this->logManager = $logManager;
    }
    
    /**
     * Get Log Manager
     * @return LogManager
     */
    function getLogManager()
    {
        if (empty($this->logManager)) {
            $manager = $this->getManager('log');//try to load it using app
            if (empty($manager)) {
                throw new Exception('Log manager undefined');
            }
        }
        
        return $this->logManager;
    }

}
