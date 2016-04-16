<?php

/**
 * File for Service Input class
 */

namespace Cayman;

/**
 * Class for Service Input
 *
 */
class ServiceInput
{
    use Library\ObjectHydratorTrait;
    
    /**
     * Constructor
     * @param array $data
     */
    function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data, $this);
        }
    }
}
