<?php
/**
 * File for Filter Manager interface
 */

namespace Cayman\Manager;

use Cayman\Manager\FilterManager\Input;

/**
 * Interface for Filter Manager
 */
interface FilterManager
{
    
    /**
     * Filter one input
     * @param Input $input
     * @return mixed filtered input
     */
    function filter(Input $input);
    
}
