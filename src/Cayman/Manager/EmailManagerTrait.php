<?php
/**
 * File for Email Manager trait
 */

namespace Cayman\Manager;

use Cayman\ExceptionManagerUndefined;

/**
 * Trait for Email Manager
 *
 */
trait EmailManagerTrait
{
    
    /**
     * Email Manager object
     * @var EmailManager
     */
    private $emailManager;
    
    /**
     * Set Email Manager
     * @param EmailManager $emailManager
     * @return void
     */
    function setEmailManager(EmailManager $emailManager)
    {
        $this->emailManager = $emailManager;
    }
    
    /**
     * Get Email Manager
     * @return EmailManager
     */
    function getEmailManager()
    {
        if (empty($this->emailManager)) {
            $manager = $this->getManager('email');//try to load it using app
            if (empty($manager)) {
                throw new ExceptionManagerUndefined('Email manager undefined');
            }
        }
        
        return $this->emailManager;
    }
    
}
