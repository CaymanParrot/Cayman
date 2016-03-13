<?php
/**
 * File for Cache Manager interface
 */

namespace Cayman\Manager;

/**
 * Interface for Cache Manager
 */
interface CacheManager
{
    
    /**
     * Set data for ID and keep it for X minutes
     * 
     * @param string $id
     * @param string $data
     * @param int    $lifeTime
     * @return bool
     */
    function cacheSet($id, $data, $lifeTime = 0);
    
    /**
     * Get data for cached ID given
     * 
     * @param string $id
     * @return string
     */
    function cacheGet($id);
    
    /**
     * Delete cached ID
     * 
     * @param string $id
     * @return bool
     */
    function cacheDelete($id);

}
