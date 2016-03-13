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
    use Manager\RedisTrait;
    
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
