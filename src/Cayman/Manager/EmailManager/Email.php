<?php
/**
 * File for Email class
 */

namespace Cayman\Manager\EmailManager;

/**
 * Class for Email
 *
 */
class Email
{
    /**
     * Sender's address
     * @var string
     */
    public $from;
    
    /**
     * Reply-to address
     * @var string
     */
    public $reply_to;
    
    /**
     * Recipients
     * @var array
     */
    public $to = [];
    
    /**
     * Recipients of carbon-copy
     * @var array
     */
    public $cc = [];
    
    /**
     * Recipients of blind-carbon-copy
     * @var array
     */
    public $bcc = [];
    
    /**
     * Subject
     * @var string
     */
    public $subject = '';
    
    /**
     * Message
     * @var string
     */
    public $message = '';
    
}
