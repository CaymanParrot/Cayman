<?php
/**
 * File for Service Class
 */

namespace Cayman;

/**
 * Class for Service
 * 
 */
abstract class Service
{
    use ApplicationTrait;
    use Library\SettingsTrait;
    
    /**
     * Create a new service instance
     * @param Application $app
     * @param Settings    $settings
     * @return Service
     */
    static function newService(Application $app, Settings $settings)
    {
        $service = new static();
        $service->setApp($app);
        $service->setSettings($settings);
        
        return $service;
    }
    
    /**
     * Get help
     * @param Input $input
     * @return Output
     */
    abstract function help(Input $input);
}
