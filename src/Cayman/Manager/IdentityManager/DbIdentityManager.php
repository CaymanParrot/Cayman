<?php
/**
 * File for Database Identity Manager class
 */

namespace Cayman\Manager\IdentityManager;

use Cayman\Manager;
use Cayman\Manager\IdentityManager;

/**
 * Class for Database Identity Manager
 *
 */
class DbIdentityManager extends Manager implements IdentityManager
{
    
    function getTableName()
    {
        
    }
    
    function getUserIdColumn()
    {
        
    }
    
    function getUserNameColumn()
    {
        
    }
    
    function getPasswordColumn()
    {
        
    }
    
    /**
     * Check identity
     * @param Credentials $credentials
     */
    function identityCheck(Credentials $credentials)
    {
        //TODO: implement
    }
}
