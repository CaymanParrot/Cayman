<?php
/**
 * File for Local Disk Asset Manager class
 */

namespace Cayman\Manager\AssetManager;

use Cayman\Manager;
use Cayman\Manager\AssetManager;

/**
 * Class for Local Disk
 *
 */
class LocalDisk extends Manager implements AssetManager
{
    
    /**
     * Create asset
     * 
     * @param string      $key
     * @param SplFileInfo $file
     * @return bool
     */
    function assetCreate($key, SplFileInfo $file)
    {
        //TODO: implement
    }
    
    /**
     * Retrieve asset
     * 
     * @param string $key
     * @return string
     */
    function assetRetrieve($key)
    {
        //TODO: implement
    }
    
    /**
     * Delete asset
     * 
     * @param string $key
     * @return bool
     */
    function assetDelete($key)
    {
        //TODO: implement
    }
}
