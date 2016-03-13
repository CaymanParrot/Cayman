<?php
/**
 * File for Locale Manager trait
 */

namespace Cayman\Manager;

use Cayman\ExceptionManagerUndefined;

/**
 * Trait for Locale Manager
 *
 */
trait LocaleManagerTrait
{
    
    /**
     * Locale Manager object
     * @var LocaleManager
     */
    private $localeManager;
    
    /**
     * Set Locale Manager
     * @param LocaleManager $localeManager
     * @return void
     */
    function setLocaleManager(LocaleManager $localeManager)
    {
        $this->localeManager = $localeManager;
    }
    
    /**
     * Get Locale Manager
     * @return LocaleManager
     */
    function getLocaleManager()
    {
        if (empty($this->localeManager)) {
            $manager = $this->getManager('locale');//try to load it using app
            if (empty($manager)) {
                throw new ExceptionManagerUndefined('Locale manager undefined');
            }
        }
        
        return $this->localeManager;
    }
    
        
}
