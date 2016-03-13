<?php
/**
 * File for Redis Cache Manager
 */

namespace Cayman\Manager\CacheManager;

use Cayman\Exception;
use Cayman\Manager;
use Cayman\Manager\CacheManager;

/**
 * Class for Redis Cache Manager
 *
 */
class RedisCache extends Manager implements CacheManager
{
    /**
     * Redis object
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
            throw new Exception('Redis undefined');
        }
        
        return $this->redis;
    }
    
    /**
     * Set data for ID and keep it for X minutes
     * 
     * @param string $id
     * @param string $data
     * @param int    $lifeTime
     * @return bool
     */
    function cacheSet($id, $data, $lifeTime = 0)
    {
        //TODO: implement
    }
    
    /**
     * Get data for cached ID given
     * 
     * @param string $id
     * @return string
     */
    function cacheGet($id)
    {
        //TODO: implement
    }
    
    /**
     * Delete cached ID
     * 
     * @param string $id
     * @return bool
     */
    function cacheDelete($id)
    {
        //TODO: implement
    }
}
