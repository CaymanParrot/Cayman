<?php
/**
 * File for Email Manager interface
 */

namespace Cayman\Manager;

use Cayman\Manager\EmailManager\Email;

/**
 * Interface for Email Manager
 */
interface EmailManager
{
    
    /**
     * Send email
     * @param Email $email
     */
    function emailSend(Email $email);

}
