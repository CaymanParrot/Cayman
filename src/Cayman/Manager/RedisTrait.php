<?php
/**
 * File for Redis trait
 */

namespace Cayman\Manager;

use Cayman\ExceptionManagerUndefined;

/**
 * Trait for Redis
 *
 */
trait RedisTrait
{
    
    /**
     * Redis Manager object
     * @var \Redis
     */
    private $redis;
    
    /**
     * Set Redis
     * @param \Redis $redis
     * @return void
     */
    function setRedis(\Redis $redis)
    {
        $this->redis = $redis;
    }
    
    /**
     * Get Redis
     * @return \Redis
     */
    function getRedis()
    {
        if (empty($this->redis)) {
            $manager = $this->getManager('redis');//try to load it using app
            if (empty($manager)) {
                throw new ExceptionManagerUndefined('Redis connection undefined');
            }
        }
        
        return $this->redis;
    }

}
