<?php
/**
 * File for Filter Manager trait
 */

namespace Cayman\Manager;

use Cayman\ExceptionManagerUndefined;

/**
 * Trait for Filter Manager
 *
 */
trait FilterManagerTrait
{
    
    /**
     * Filter Manager object
     * @var FilterManager
     */
    private $filterManager;
    
    /**
     * Set Filter Manager
     * @param FilterManager $filterManager
     * @return void
     */
    function setFilterManager(FilterManager $filterManager)
    {
        $this->filterManager = $filterManager;
    }
    
    /**
     * Get Filter Manager
     * @return FilterManager
     */
    function getFilterManager()
    {
        if (empty($this->filterManager)) {
            $manager = $this->getManager('filter');//try to load it using app
            if (empty($manager)) {
                throw new ExceptionManagerUndefined('Filter manager undefined');
            }
        }
        
        return $this->filterManager;
    }
    
}
