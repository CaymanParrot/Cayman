<?php

/**
 * File for DB Locale Manager
 */

namespace Cayman\Manager\LocaleManager;

use Cayman\Manager;
use Cayman\Manager\LocaleManager;

/**
 * Class for PHP Log
 *
 */
class DbLocaleManager extends Manager implements LocaleManager
{
    
    /**
     * Set current locale
     * @param string $localeId
     * @return bool
     */
    function currentLocaleSet($localeId)
    {
        
    }
    
    /**
     * Save translation 
     * @param string $id
     * @param string $localeId   If empty, use current locale
     * @param string $data
     * @return bool
     */
    function translationSet($id, $localeId, $data)
    {
        
    }
    
    /**
     * Get translation 
     * @param string $id
     * @param string $localeId  If empty, use current locale
     * @return string
     */
    function translationGet($id, $localeId = '')
    {
        
    }
}
