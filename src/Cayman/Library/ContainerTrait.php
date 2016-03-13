<?php
/**
 * File for Container Trait
 */

namespace Cayman\Library;

use Cayman\Exception;

/**
 * Trait for setting and getting Container
 *
 */
trait ContainerTrait
{
    /**
     * Container
     * @var Container
     */
    private $container;
    
    /**
     * Set container objects
     * @param Container $container
     * @return void
     */
    function setContainer(Container $container)
    {
        $this->container = $container;
    }
    
    /**
     * Get container object
     * @return Container
     */
    function getContainer()
    {
        if (empty($this->container)) {
            throw new Exception('Container undefined');
        }
        
        return $this->container;
    }
}
