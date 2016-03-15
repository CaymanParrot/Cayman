<?php
/**
 * File for Database Expression class
 */

namespace Cayman\Manager;

/**
 * Class for Database Expression
 *
 */
class DbExpression
{
    /**
     * Database expression
     * @var string
     */
    public $value;
    
    /**
     * Constructor
     * @param string $value
     */
    function __construct($value)
    {
        $this->value = $value;
    }
    
}
