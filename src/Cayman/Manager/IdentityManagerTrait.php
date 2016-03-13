<?php
/**
 * File for Identity Manager trait
 */

namespace Cayman\Manager;

use Cayman\ExceptionManagerUndefined;

/**
 * Trait for Identity Manager
 *
 */
trait IdentityManagerTrait
{
    
    /**
     * Identity Manager object
     * @var IdentityManager
     */
    private $identityManager;
    
    /**
     * Set Identity Manager
     * @param IdentityManager $identityManager
     * @return void
     */
    function setIdentityManager(IdentityManager $identityManager)
    {
        $this->identityManager = $identityManager;
    }
    
    /**
     * Get Identity Manager
     * @return IdentityManager
     */
    function getIdentityManager()
    {
        if (empty($this->identityManager)) {
            $manager = $this->getManager('identity');//try to load it using app
            if (empty($manager)) {
                throw new ExceptionManagerUndefined('Identity manager undefined');
            }
        }
        
        return $this->identityManager;
    }
    
}
