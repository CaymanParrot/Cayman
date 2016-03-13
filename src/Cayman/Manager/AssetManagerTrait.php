<?php
/**
 * File for Asset Manager trait
 */

namespace Cayman\Manager;

use Cayman\ExceptionManagerUndefined;

/**
 * Trait for Asset Manager
 *
 */
trait AssetManagerTrait
{
    /**
     * Asset manager object
     * @var AssetManager
     */
    private $assetManager;
    
    /**
     * Set asset manager
     * @param AssetManager $assetManager
     * @return void
     */
    function setAssetManager(AssetManager $assetManager)
    {
        $this->assetManager = $assetManager;
    }
    
    /**
     * Get asset manager
     * @return AssetManager
     */
    function getAssetManager()
    {
        if (empty($this->assetManager)) {
            $manager = $this->getManager('asset');//try to load it using app
            if (empty($manager)) {
                throw new ExceptionManagerUndefined('Asset manager undefined');
            }
        }
        
        return $this->assetManager;
    }
    
}
