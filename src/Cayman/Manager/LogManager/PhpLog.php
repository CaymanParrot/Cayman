<?php
/**
 * File for PHP Log Manager class
 */

namespace Cayman\Manager\LogManager;

use Cayman\Manager;
use Cayman\Manager\LogManager;

/**
 * Class for PHP Log Manager
 *
 */
class PhpLog extends Manager implements LogManager
{
    
    /**
     * Append message to log
     * 
     * @param string $message
     * @param string $level
     * @return bool
     */
    function log($message, $level = 'info')
    {
        $file   = $this->settings->file;
        $result = error_log($message, $fileDestination = 3, $file);
        
        return $result;
    }
}
