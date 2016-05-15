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
        
        if (is_null($object)) {
            $object = $this;
        }
        
        $mapping = [];
        if ($this instanceof ObjectHydrationMappingInterface) {
            $mapping = $this->getHydrationMapping();
        }
        
        foreach($data as $property => $value) {
            //TODO: make sure we populate public properties only
            if (! property_exists($object, $property)) {
                continue;//skip, invalid property
            }
                
            if (isset($mapping[$property])) {
                
                $mappingHandler = $mapping[$property];
                if (is_callable($mappingHandler)) {
                    
                    $callbackParams = [ $value, $property, $object ];
                    $valueObj = call_user_func_array($mappingHandler, $callbackParams);
                    
                } else {// otherwise, we expect a class name
                    
                    $valueObj = new $mappingHandler();
                    if (method_exists($valueObj, 'hydrate')) {
                        $valueObj->hydrate($value);//it can hydrate
                    } else {
                        $object->hydrate($value, $valueObj);// RECURSION *** we hydrate it using this object
                    }
                }
                $value = $valueObj;//override value
                
            } elseif($object instanceof ObjectHydrationPropertyMakerInterface) {
                $value = $object->makeProperty($property, $value);
            }
            
            $object->$property = $value;//otherwise
            $counter++;
        }
        
        return $counter;
    }
}
