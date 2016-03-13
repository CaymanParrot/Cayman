<?php
/**
 * File for Release Manager trait
 */

namespace Cayman\Manager;

use Cayman\ExceptionManagerUndefined;

/**
 * Trait for Release Manager
 *
 */
trait ReleaseManagerTrait
{
    
    /**
     * Release Manager object
     * @var ReleaseManager
     */
    private $releaseManager;
    
    /**
     * Set Release
     * @param ReleaseManager $releaseManager
     * @return void
     */
    function setReleaseManager(ReleaseManager $releaseManager)
    {
        $this->releaseManager = $releaseManager;
    }
    
    /**
     * Get Release Manager
     * @return ReleaseManager
     */
    function getReleaseManager()
    {
        if (empty($this->releaseManager)) {
            $manager = $this->getManager('release');//try to load it using app
            if (empty($manager)) {
                throw new ExceptionManagerUndefined('Release manager undefined');
            }
        }
        
        return $this->releaseManager;
    }
    
}
