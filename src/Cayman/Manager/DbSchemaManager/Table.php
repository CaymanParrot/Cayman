<?php

/**
 * File for Table definition class
 */

namespace Cayman\Manager\DbSchemaManager;

/**
 * Class for Table definition
 *
 */
class Table
{
    public $name;
    
    public $columns;
    
    public $primaryKey;
    
    public $indexes;
    
    public $foreignKeys;
}
