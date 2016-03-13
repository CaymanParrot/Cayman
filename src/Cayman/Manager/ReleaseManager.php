<?php
/**
 * File for Release Manager interface
 */

namespace Cayman\Manager;

/**
 * Interface for Release Manager
 */
interface ReleaseManager
{

    /**
     * Upgrade
     * @param string $version
     */
    function releaseUpgrade($version);
    
    /**
     * Downgrade
     * @param string $version
     */
    function releaseDowngrade($version);

}
