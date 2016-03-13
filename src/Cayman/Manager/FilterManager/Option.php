<?php
/**
 * File for Options class
 */

namespace Cayman\Manager\FilterManager;

/**
 * Class for Option
 *
 */
abstract class Option
{
    
    public $filterName;
    
    public $errorMessage = 'Invalid input';
    
    public $params = [];
    
    function __construct($filterName, $errorMessage, $params = [])
    {
        $this->filterName   = $filterName;
        $this->errorMessage = $errorMessage;
        $this->params       = $params;
    }
}
