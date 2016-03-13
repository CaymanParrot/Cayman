<?php
/**
 * File for Cache Manager trait
 */

namespace Cayman\Manager;

use Cayman\ExceptionManagerUndefined;

/**
 * Trait for Cache Manager
 *
 */
trait CacheManagerTrait
{
    
    /**
     * Cache manager object
     * @var CacheManager
     */
    private $cacheManager;
    
    /**
     * Set cache manager
     * @param CacheManager $cacheManager
     * @return void
     */
    function setCacheManager(CacheManager $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }
    
    /**
     * Get cache manager
     * @return CacheManager
     */
    function getCacheManager()
    {
        if (empty($this->cacheManager)) {
            $manager = $this->getManager('cache');//try to load it using app
            if (empty($manager)) {
                throw new ExceptionManagerUndefined('Cache manager undefined');
            }
        }
        
        return $this->cacheManager;
    }
    
}
