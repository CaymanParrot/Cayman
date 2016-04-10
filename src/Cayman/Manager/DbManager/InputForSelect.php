<?php

/**
 * File for input class of select function of db manager
 */

namespace Cayman\Manager\DbManager;

/**
 * Class for input of select function of db manager
 *
 */
class InputForSelect
{
    /**
     * Select statement
     * @var string
     */
    public $sql;
    
    /**
     * Parameters
     * @var array
     */
    public $parameters = [];
    
    /**
     * Class name of records to be returned and hydrated
     * Associative arrays will be returned, if class name is not given
     * @var string
     */
    public $className;
}
