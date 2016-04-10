<?php
/**
 * File for Settings Trait
 */

namespace Cayman;

/**
 * Trait for setting and getting Settings
 *
 */
trait SettingsTrait
{
    /**
     * Settings
     * @var Settings
     */
    private $settings;
    
    /**
     * Set settings objects
     * @param Settings $settings
     * @return void
     */
    function setSettings(Settings $settings)
    {
        $this->settings = $settings;
        $this->afterNewSettings();
    }
    
    /**
     * Override to do special operations
     * @return void
     */
    function afterNewSettings()
    {
        //do something
    }
    
    /**
     * Get settings object
     * @return Settings
     */
    function getSettings()
    {
        if (empty($this->settings)) {
            throw new Exception('Settings undefined');
        }
        
        return $this->settings;
    }
}
