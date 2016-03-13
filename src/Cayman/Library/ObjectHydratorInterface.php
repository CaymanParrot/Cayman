<?php
/**
 * File for object hydrator interface
 */

namespace Cayman\Library;

/**
 * Trait to hydrate objects
 *
 */
interface ObjectHydratorInterface
{
    /**
     * Hydrate data, populate properties of object
     * 
     * @param array    $data
     * @param stdClass $object By default, $this will be used, otherwise we can pass an object as destination of data
     * @return int     number of properties populated
     */
    function hydrate($data = [], $object = null);
    
}
