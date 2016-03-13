<?php
/**
 * File for Locale Manager interface
 */

namespace Cayman\Manager;

/**
 * Interface for Locale Manager
 */
interface LocaleManager
{
    /**
     * Set current locale
     * @param string $localeId
     * @return bool
     */
    function currentLocaleSet($localeId);
    
    /**
     * Save translation 
     * @param string $id
     * @param string $localeId   If empty, use current locale
     * @param string $data
     * @return bool
     */
    function translationSet($id, $localeId, $data);
    
    /**
     * Get translation 
     * @param string $id
     * @param string $localeId  If empty, use current locale
     * @return string
     */
    function translationGet($id, $localeId = '');

}
