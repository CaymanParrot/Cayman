<?php
/**
 * File for Queue Message
 */

namespace Cayman\Manager\QueueManager;

/**
 * Class for Queue Message
 *
 */
class Message
{
    /**
     * URI to route message to one of our services
     * @var string
     */
    public $uri;
    
    /**
     * Data
     * @var array
     */
    public $data = [];
}
