<?php
/**
 * File for trait to hydrate objects
 */

namespace Cayman\Library;

/**
 * Trait to hydrate objects
 *
 */
trait ObjectHydratorTrait
{
    /**
     * Hydrate data, populate properties of object
     * 
     * @param array    $data   Array or object as data source
     * @param stdClass $object By default, $this will be used, otherwise we can pass an object as destination of data
     * @return int     number of properties populated (at top level)
     */
    function hydrate($data = [], $object = null)
    {
        $counter = 0;
        
        $mapping = [];
        if ($this instanceof ObjectHydrationMappingInterface) {
            $mapping = $this->getHydrationMapping();
        }
        
        if (is_null($object)) {
            $object = $this;
        }
        
        foreach($data as $property => $value) {
            //TODO: make sure we populate public properties only
            if (property_exists($object, $property)) {
                if (is_scalar($value)) {
                    $object->$property = $value;
                    $counter++;
                } elseif (is_array($value) or is_object($value)) {
                    //if special case is defined in mapping
                    if (isset($mapping[$property])) {
                        $class    = $mapping[$property];
                        $valueObj = new $class();
                        $object->hydrate($value, $valueObj);// RECURSION ***
                        $value = $valueObj;//override value
                    }
                    $object->$property = $value;
                    $counter++;
                }
            }
        }
        
        return $counter;
    }
}
