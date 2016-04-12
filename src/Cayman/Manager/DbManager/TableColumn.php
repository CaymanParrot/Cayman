<?php

/**
 * File for Column class
 */

namespace Cayman\Manager\DbManager;

/**
 * Class for Column
 *
 * SQL:
 * <pre>
 *   select *
 *   from information_schema.columns c
 *   where c.table_schema = 'public'
 *     and c.table_name = 'tbl_entity'
 *     -- and c.table_catalog = '[dbname]'
 *   order by c.ordinal_position;
 * </pre>
 * 
 */
class TableColumn
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
     * Column name
     * @var string
     */
    public $column_name;
    
    /**
     * Ordinal position
     * @var int
     */
    public $ordinal_position;
    
    /**
     * Column default
     * @var string
     */
    public $column_default;
    
    /**
     * Column is nullable or not
     * @var bool
     */
    public $is_nullable;
    
    /**
     * Data type
     * @var string
     */
    public $data_type;
    
    /**
     * Character maximum length
     * @var int
     */
    public $character_maximum_length;
    
    /**
     * Character octet length
     * @var int
     */
    public $character_octet_length;
    
    /**
     * Numeric precision
     * @var int
     */
    public $numeric_precision;
    
    /**
     * Numeric precision radix
     * @var int
     */
    public $numeric_precision_radix;
    
    /**
     * Numeric scale
     * @var int
     */
    public $numeric_scale;
    
    /**
     * Datetime precision
     * @var int
     */
    public $datetime_precision;
    
    /**
     * Interval type
     * @var string
     */
    public $interval_type;
    
    /**
     * Interval precision
     * @var string
     */
    public $interval_precision;
    
    /**
     * Character set catalog
     * @var string
     */
    public $character_set_catalog;
    
    /**
     * Character set schema
     * @var string
     */
    public $character_set_schema;
    
    /**
     * Character set name
     * @var string
     */
    public $character_set_name;
    
    /**
     * Collation catalog
     * @var string
     */
    public $collation_catalog;
    
    /**
     * Collation schema
     * @var string
     */
    public $collation_schema;
    
    /**
     * Collation name
     * @var string
     */
    public $collation_name;
    
    /**
     * Domain catalog
     * @var string
     */
    public $domain_catalog;
    
    /**
     * Domain schema
     * @var string
     */
    public $domain_schema;
    
    /**
     * Domain name
     * @var string
     */
    public $domain_name;
    
    /**
     * UDT catalog
     * @var string
     */
    public $udt_catalog;
    
    /**
     * UDT schema
     * @var string
     */
    public $udt_schema;
    
    /**
     * UDT name
     * @var string
     */
    public $udt_name;
    
    /**
     * Scope catalog
     * @var string
     */
    public $scope_catalog;
    
    /**
     * Scope schema
     * @var string
     */
    public $scope_schema;
    
    /**
     * Scope name
     * @var string
     */
    public $scope_name;
    
    /**
     * Maximum cardinality
     * @var int
     */
    public $maximum_cardinality;
    
    /**
     * DTD identifier
     * @var int
     */
    public $dtd_identifier;
    
    /**
     * Column is self referencing or not
     * @var bool
     */
    public $is_self_referencing;
    
    /**
     * Column is identity or not
     * @var bool
     */
    public $is_identity;
    
    /**
     * Identity generation
     * @var string
     */
    public $identity_generation;
    
    /**
     * Identity start
     * @var int
     */
    public $identity_start;
    
    /**
     * Identity increment
     * @var int
     */
    public $identity_increment;
    
    /**
     * Identity maximum
     * @var int
     */
    public $identity_maximum;
    
    /**
     * Identity minimum
     * @var int
     */
    public $identity_minimum;
    
    /**
     * Identity cycle
     * @var int
     */
    public $identity_cycle;
    
    /**
     * Column is generated or not
     * @var bool
     */
    public $is_generated;
    
    /**
     * Generation expression
     * @var string
     */
    public $generation_expression;
    
    /**
     * Column is updatable or not
     * @var bool
     */
    public $is_updatable;
    
    /**
     * Check whether a value for column is required and can be input by user or not
     * @return bool
     */
    function isRequired()
    {
        return ! $this->is_nullable && ! $this->is_generated && $this->is_updatable;
    }
}
