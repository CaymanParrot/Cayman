<?php

/**
 * File for Table definition class
 */

namespace Cayman\Manager\DbManager;

use Cayman\Manager\DbManager;
use Cayman\Manager\DbManager\Row;
use Cayman\Manager\DbManager\InputForSelect;
use Cayman\Manager\DbManager\OutputForSelect;

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
class Table extends View
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
     * @var Column[]
     */
    protected $columns = [];
    
    /**
     * Constraints
     * @var Constraint[]
     */
    protected $constraints = [];
    
    protected $indexes = [];
    
    protected $foreignKeys = [];
    
    /**
     * Get name e.g. 'tbl_user'
     * @return string
     */
    function getName()
    {
        return $this->table_name;
    }
    
    /**
     * Get schema name e.g. 'public'
     * @return string
     */
    function getSchemaName()
    {
        return $this->table_schema;
    }
    
    /**
     * Copy table data into this table
     * @param Table $sourceTable
     * @return void
     */
    function copyTable(Table $sourceTable)
    {
        $data = $sourceTable->toArray();
        $this->hydrate($data);
    }
    
    /**
     * Reset columns i.e. empty the array of columns
     * @return void
     */
    function resetColumns()
    {
        $this->columns = [];
    }
    
    /**
     * Add column
     * @param TableColumn $column
     * @return void
     */
    function addColumn(TableColumn $column)
    {
        $name = $column->column_name;
        $this->columns[$name] = $column;
    }
    
    /**
     * Get columns
     * @return TableColumn[]
     */
    function getColumns()
    {
        return $this->columns;
    }
    
    /**
     * Get column
     * @param string $name
     * @return TableColumn | null
     */
    function getColumn($name)
    {
        return isset($this->columns[$name]) ? $this->columns[$name] : null;
    }
    
    /**
     * Find row
     * @param mixed $id scalar value or array
     * @return Row
     */
    function find($id)
    {
        $id = is_array($id) ? $id : [ $id ];
        
        $input = new InputForSelect();
        $input->sql = $this->getSql();
        $keys  = $this->getPrimaryKey();
        $where = [];
        foreach($keys as $idx => $key) {
            $where[] = sprintf('"%s" = ?', $key);
            $input->parameters[] = $id[$idx];
        }
        $input->sql .= ' WHERE (' . implode(') AND (', $where) . ')';
        $output = $this->getDb()->dbSelect($input);
        $row = isset($output->rows[0]) ? $output->rows[0] : null;
        
        return $row;
    }
}
