<?php
/**
 * File for interface for object hydration property setter
 */

namespace Cayman\Library;

/**
 * Interface for object hydration property setter
 */
interface ObjectHydrationPropertyMakerInterface
{
    /**
     * Set property value
     * @param string $property
     * @param mixed  $value
     * @return mixed
     */
    function makeProperty($property, $value);
}
