<?php

/**
 * File for Table Constraint class
 */

namespace Cayman\Manager\DbSchemaManager;

/**
 * Class for Table Constraint
 *
 */
class TableConstraint
{
    /**
     * Catalog name
     * @var string
     */
    public $table_catalog;
    
    /**
     * Schema name
     * @var string
     */
    public $table_schema;
    
    /**
     * Table name
     * @var string
     */
    public $table_name;
    
    /**
     * Constraint catalog
     * @var string
     */
    public $constraint_catalog;
    
    /**
     * Constraint schema
     * @var string
     */
    public $constraint_schema;
    
    /**
     * Constraint name
     * @var string
     */
    public $constraint_name;
    
    /**
     * Constraint type
     * @var string
     */
    public $constraint_type;
    
    /**
     * Constraint is deferrable or not
     * @var bool
     */
    public $is_deferrable;
    
    /**
     * Constraint is deferrable or not
     * @var bool
     */
    public $initially_deferred;
    
    
    const TYPE_PRIMARY_KEY = 'PRIMARY KEY';
    const TYPE_UNIQUE      = 'UNIQUE';
    const TYPE_CHECK       = 'CHECK';
}
