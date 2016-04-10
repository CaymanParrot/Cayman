<?php

/**
 * File for Table definition class
 */

namespace Cayman\Manager\DbSchemaManager;

/**
 * Class for Table definition
 *
 * SQL:
 * <pre>
 *   select *
 *   from information_schema.tables t
 *   where t.table_schema = 'public'
 *   -- and t.table_catalog = '[dbname]'
 *   ;
 * </pre>
 * 
 */
class Table
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
     * Table type
     * @var string
     */
    public $table_type;
    
    /**
     * Self referencing column name
     * @var string
     */
    public $self_referencing_column_name;
    
    /**
     * Reference generation
     * @var string
     */
    public $reference_generation;
    
    /**
     * User defined type catalog
     * @var string
     */
    public $user_defined_type_catalog;
    
    /**
     * User defined type schema
     * @var string
     */
    public $user_defined_type_schema;
    
    /**
     * User defined type name
     * @var string
     */
    public $user_defined_type_name;
    
    /**
     * Table is insertable (into) or not
     * @var bool
     */
    public $is_insertable_into;
    
    /**
     * Table is typed
     * @var bool
     */
    public $is_typed;
    
    /**
     * Commit action
     * @var string
     */
    public $commit_action;
    
    /**
     * Columns
     * @var TableColumn[]
     */
    protected $columns = [];
    
    /**
     * Constraints
     * @var TableConstraint[]
     */
    protected $constraints = [];
    
    protected $primaryKey = [];
    
    protected $indexes = [];
    
    protected $foreignKeys = [];
}
