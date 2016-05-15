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
     * <pre>
     * return [
     *   'propertyA' => ExampleClass::class,
     *   'propertyB' => function ($value, $property, $object) {
     *     return (string) $value;
     *   },
     *   'propertyC' => function ($value, $property, $object) {
     *     $obj = new AnotherClass();
     *     $obj->xyz = $value;
     *     return $object;
     *   }
     * ]
     * </pre>
     * @return array
     */
    function getHydrationMapping();
}
