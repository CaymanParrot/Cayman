<?php
/**
 * File for interface for defining mapping to help object hydrator
 */

namespace Cayman\Library;

/**
 * Interface for defining mapping to help object hydrator
 */
interface ObjectHydrationMappingInterface
{
    /**
     * Get an associative array of property and class to instantiate and hydrate properties
     * @return array
     */
    function getHydrationMapping();
}
