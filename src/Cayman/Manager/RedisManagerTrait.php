<?php
/**
 * File for Redis Manager trait
 */

namespace Cayman\Manager;

use Cayman\ExceptionManagerUndefined;

/**
 * Trait for Redis Manager
 *
 */
trait RedisManagerTrait
{
    
    /**
     * Redis Manager object
     * @var \Redis
     */
    private $redisManager;
    
    /**
     * Set Redis Manager
     * @param \Redis $redisManager
     * @return void
     */
    function setRedisManager(\PDO $redisManager)
    {
        $this->redisManager = $redisManager;
    }
    
    /**
     * Get Redis Manager
     * @return \Redis
     */
    function getRedisManager()
    {
        if (empty($this->redisManager)) {
            $manager = $this->getManager('redis');//try to load it using app
            if (empty($manager)) {
                throw new ExceptionManagerUndefined('Redis manager undefined');
            }
        }
        
        return $this->redisManager;
    }

}
