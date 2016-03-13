<?php
/**
 * File for Error class
 */

namespace Cayman;

/**
 * Class for Error
 *
 */
class Error
{
    /**
     * Error code
     * @var string
     */
    public $code;
    
    /**
     * Error message
     * @var string
     */
    public $message;
    
    /**
     * Meta data related to the error
     * @var array
     */
    public $meta = [];
}
