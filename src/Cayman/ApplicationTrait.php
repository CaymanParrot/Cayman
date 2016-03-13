<?php
/**
 * File for Application Trait
 */

namespace Cayman;

/**
 * Trait for setting and getting Application
 *
 */
trait ApplicationTrait
{
    /**
     * Application objects
     * 
     * @var Application
     */
    private $app;
    
    /**
     * Set application object
     * @param Application $app
     * @return void
     */
    function setApp(Application $app)
    {
        $this->app = $app;
    }
    
    /**
     * Get application object
     * @return Application
     */
    function getApp()
    {
        if (empty($this->app)) {
            throw new Exception('Application undefined');
        }
        
        return $this->app;
    }
}
