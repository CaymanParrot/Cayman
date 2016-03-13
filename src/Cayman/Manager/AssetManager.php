<?php
/**
 * File for Asset Manager interface
 */

namespace Cayman\Manager;

/**
 * Interface for Asset Manager
 */
interface AssetManager
{
    
    /**
     * Create asset
     * 
     * @param string      $key
     * @param SplFileInfo $file
     * @return bool
     */
    function assetCreate($key, SplFileInfo $file);
    
    /**
     * Retrieve asset
     * 
     * @param string $key
     * @return string
     */
    function assetRetrieve($key);
    
    /**
     * Delete asset
     * 
     * @param string $key
     * @return bool
     */
    function assetDelete($key);

}
