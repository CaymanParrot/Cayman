<?php

/**
 * File for common input class
 */

namespace Cayman\Manager\DbManager;

/**
 * Class for common input
 *
 */
class InputCommon
{
    use \Cayman\Library\ObjectHydratorTrait;
    
    /**
     * Construct
     * @param array $data
     */
    function __construct(array $data = [])
    {
        if (! empty($data)) {
            $this->hydrate($data, $this);
        }
    }
}
