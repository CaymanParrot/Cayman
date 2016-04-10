<?php

/**
 * File for input class of statement function of db manager
 */

namespace Cayman\Manager\DbManager;

/**
 * Class for input of statement function of db manager
 *
 */
class InputForStatement
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
}
