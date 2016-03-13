<?php
/**
 * File for object properties functions
 */

namespace Cayman\Library;

use ReflectionClass;
use ReflectionProperty;

/**
 * Trait for object properties functions
 *
 */
trait ObjectPropertiesTrait
{
    
    /**
     * Get public properties
     * @return array
     */
    protected function getPublicProperties()
    {
        $result = [];
        
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach($properties as $property) {
            $result[] = $property->getName();
        }
        
        return $result;
    }
    
}
