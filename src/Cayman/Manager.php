<?php
/**
 * File for Manager Class
 */

namespace Cayman;

/**
 * Class for Manager
 * 
 */
abstract class Manager
{
    use ApplicationTrait;
    use Library\SettingsTrait;
    
    /**
     * Identifier for manager
     * esp. when there are multiple instances with different implementations
     * @var string
     */
    public $id = 'default';
    
    /**
     * Empty constructor
     */
    function __construct()
    {
        // do nothing
        // dependencies will be injected later
    }
    
    /**
     * Create a new manager instance
     * @param Application $app
     * @param Settings    $settings
     * @param string      $id
     * @return Manager
     */
    static function newManager(Application $app, Settings $settings, $id = 'default')
    {
        $manager = new static();
        $manager->id = $id;
        $manager->setApp($app);
        $manager->setSettings($settings);
        
        return $manager;
    }
    
    /**
     * Get manager - lazily load singletons for each type/id of manager
     * @param string $type
     * @return Manager
     */
    function getManager($type)
    {
        $settings = $this->getSettings();
        $id       = $settings->$type ?: 'default';
        $result   = $this->getApp()->getManager($type, $id);
        
        return $result;
    }
    
    /**
     * Broadcast event
     * @param string       $eventName
     * @param EventContext $context
     * @return void
     */
    function event($eventName, EventContext $context)
    {
        return $this->getManager('event')->eventBroadcast($eventName, $context);
    }
    
    /**
     * Append message to log
     * 
     * @param string $message
     * @param string $level
     * @return bool
     */
    function log($message, $level = 'info')
    {
        return $this->getManager('log')->log($message, $level);
    }
    
}
