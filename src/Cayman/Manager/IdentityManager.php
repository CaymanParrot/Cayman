<?php
/**
 * File for Identity Manager interface
 */

namespace Cayman\Manager;

use Cayman\Manager\IdentityManager\Credentials;

/**
 * Interface for Identity Manager
 */
interface IdentityManager
{
    
    /**
     * Check identity
     * @param Credentials $credentials
     */
    function identityCheck(Credentials $credentials);

}
