<?php
/**
 * File for Log Manager interface
 */

namespace Cayman\Manager;

/**
 * Interface for Log Manager
 */
interface LogManager
{
    
    const LEVEL_EMERGENCY = 'emergency';
    const LEVEL_ALERT     = 'alert';
    const LEVEL_CRITICAL  = 'critical';
    const LEVEL_ERROR     = 'error';
    const LEVEL_WARNING   = 'warning';
    const LEVEL_NOTICE    = 'notice';
    const LEVEL_INFO      = 'info';
    const LEVEL_DEBUG     = 'debug';
    
    /**
     * Append message to log
     * 
     * @param string $message
     * @param string $level
     * @return bool
     */
    function log($message, $level = 'info');

}
