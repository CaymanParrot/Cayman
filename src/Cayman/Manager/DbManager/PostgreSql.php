<?php
/**
 * File for PostgreSQL 9.5 Database Manager
 */

namespace Cayman\Manager\DbManager;

use Cayman\Application;
use Cayman\Settings;
use Cayman\Exception;
use Cayman\Manager;
use Cayman\Manager\DbManager;

use Cayman\Manager\DbManager\InputForInsert;
use Cayman\Manager\DbManager\OutputForInsert;

use Cayman\Manager\DbManager\InputForUpdate;
use Cayman\Manager\DbManager\OutputForUpdate;

use Cayman\Manager\DbManager\InputForDelete;
use Cayman\Manager\DbManager\OutputForDelete;

use Cayman\Manager\DbManager\InputForSelect;
use Cayman\Manager\DbManager\OutputForSelect;

use Cayman\Manager\DbManager\InputForStatement;
use Cayman\Manager\DbManager\OutputForStatement;

/**
 * Class for PostgreSQL Database Manager
 * 
 * @see http://www.postgresql.org/docs/9.5/static/sql-createtable.html
 *
 */
class PostgreSql extends Manager implements DbManager
{
    use Manager\PdoTrait;
    
    /**
     * Table array (to be used as in-class cache)
     * @var Table[]
     */
    protected $tables;
    
    /**
     * Delimiter for PostgreSQL in order to wrap identifiers to avoid clash with keywords etc.
     */
    const DELIMITER = '"';
    
    /**
     * Delimit name e.g. table name, field name, etc.
     * @param string $name
     * @return string
     */
    function dbDelimit($name)
    {
        return static::DELIMITER . $name . static::DELIMITER;
    }
    
    /**
     * Begin transaction
     * @return bool
     */
    function dbBeginTransaction()
    {
        return $this->getPdo()->beginTransaction();
    }
    
    /**
     * Commit transaction
     * @return bool
     */
    function dbCommitTransaction()
    {
        return $this->getPdo()->commit();
    }
    
    /**
     * Rollback transaction
     * @return bool
     */
    function dbRollbackTransaction()
    {
        return $this->getPdo()->rollBack();
    }
    
    /**
     * Execute query and return statement object
     * 
     * @param InputForStatement $input
     * @return OutputForStatement
     */
    function dbStatement(InputForStatement $input)
    {
        $output = new OutputForStatement();
        
        $pdo = $this->getPdo();
        if (empty($input->parameters)) {
            $statement      = $pdo->query($input->sql);
        } else {
            $statement      = $pdo->prepare($input->sql);
            $output->result = $statement->execute($input->parameters);
        }
        $output->result    = true;
        $output->statement = $statement;
        $output->rowCount  = $statement->rowCount();
        
        return $output;
    }
    
    /**
     * Execute query and return records as instance of class given
     * 
     * @param InputForSelect $input
     * @return OutputForSelect
     */
    function dbSelect(InputForSelect $input)
    {
        $output     = new OutputForSelect();
        $stmtInput  = new InputForStatement();
        $stmtInput->sql        = $input->sql;
        $stmtInput->parameters = $input->parameters;
        
        $stmtOutput = $this->dbStatement($stmtInput);
        if ($input->className) {
            $output->rows = $stmtOutput->fetchObjects($input->className);
        } else {
            $output->rows = $stmtOutput->fetchAssocArrays();
        }
        
        $output->result   = true;
        $output->rowCount = $stmtOutput->rowCount;
        
        return $output;
    }
    
    /**
     * Insert record
     * 
     * @see http://www.postgresql.org/docs/9.5/static/sql-insert.html
     * 
     * @param InputForInsert $input
     * @return OutputForInsert
     */
    function dbInsert(InputForInsert $input)
    {
        $output    = new OutputForInsert();
        $stmtInput = new InputForStatement();
        
        if (empty($input->data)) {//no data provided, use default values for all fields
            $valueList = 'DEFAULT VALUES';
        } else {
            $fieldNames   = [];
            $placeHolders = [];
            foreach($input->data as $field => $value) {
                $fieldNames[] = $this->dbDelimit($field);
                if ($value instanceof Manager\DbExpression) {
                    $placeHolders[] = $value->value;
                } else {
                    $placeHolders[] = '?';
                    $stmtInput->parameters[] = $value;
                }
            }
            $fieldNameList = '(' . implode(', ', $fieldNames) . ')';
            $valueList = 'VALUES (' . implode(', ', $placeHolders) . ')';
        }
        
        $stmtInput->sql = 'INSERT INTO ' . $this->dbDelimit($input->tableName)
            . ' ' . $fieldNameList
            . ' ' . $valueList
            . ' RETURNING ' . $input->returnFieldNames;
        $stmt = $this->dbStatement($stmtInput);
        $output->result   = true;
        $output->rowCount = $stmt->rowCount;
        $output->rows     = $stmt->fetchAll($input->className);
        
        return $output;
    }
    
    /**
     * Update record
     * 
     * @param InputForUpdate $input
     * @return OutputForUpdate
     */
    function dbUpdate(InputForUpdate $input)
    {
        $output    = new OutputForUpdate();
        $stmtInput = new InputForStatement();
        
        $fieldAssignments = [];
        foreach($input->data as $field => $value) {
            $fieldName = $this->dbDelimit($field);
            if ($value instanceof Manager\DbExpression) {
                $fieldAssignments[] = $fieldName . ' = ' . $value->value;
            } else {
                $fieldAssignments[] = $fieldName . ' = ?';
                $stmtInput->parameters[] = $value;
            }
        }
        
        foreach($input->whereParams as $value) {
            $stmtInput->parameters[] = $value;
        }
        
        $stmtInput->sql = 'UPDATE ' . $this->dbDelimit($input->tableName)
            . ' SET ' . implode(', ', $fieldAssignments)
            . ' WHERE ' . $input->where
            . ' RETURNING ' . $input->returnFieldNames;
        
        $stmt = $this->dbStatement($stmtInput);
        $output->result   = true;
        $output->rowCount = $stmt->rowCount;
        $output->rows     = $stmt->fetchAll($input->className);
        
        return $output;
    }
    
    /**
     * Delete record
     * 
     * @param InputForDelete $input
     * @return OutputForDelete
     */
    function dbDelete(InputForDelete $input)
    {
        $output    = new OutputForDelete();
        $stmtInput = new InputForStatement();
        $stmtInput->sql = 'DELETE ' . $this->dbDelimit($input->tableName)
            . ' WHERE ' . $input->where;
        $stmtInput->parameters = $input->whereParameters;
        $stmtOutput = $this->dbStatement($stmtInput);
        $output->result   = $stmtOutput->result;
        $output->rowCount = $stmtOutput->rowCount;
        
        return $output;
    }
    
    /**
     * Get catalog name
     * @return string
     */
    function dbGetCatalogName()
    {
        return $this->getSettings()->getEntry('catalog');
    }
    
    /**
     * Get schema name
     * @return string
     */
    function dbGetSchemaName()
    {
        return $this->getSettings()->getEntry('schema');
    }
    
    /**
     * Get tables
     * @return Table[]
     */
    function dbGetTables()
    {
        if (empty($this->tables)) {
            $input = new InputForSelect();
            $input->className = Table::class;
            $input->sql = <<<SQL
SELECT *
FROM information_schema.tables t
WHERE t.table_schema = ?
-- AND t.table_catalog = '[dbname]'
;
SQL;
            $input->parameters = [
                $this->dbGetSchemaName(),
            ];
            $output = $this->dbSelect($input);
            $this->tables = [];
            foreach($output->rows as $table) {
                if ($table instanceof Table) {
                    $key = $table->getFullName();
                    $this->tables[$key] = $table;
                }
            }
        }
        
        return $this->tables;
    }
    
    /**
     * Get table info
     * @param Table $table
     * @return Table
     */
    function dbGetTable(Table $table)
    {
        $key    = $table->getFullName();
        $tables = $this->dbGetTables();//load in-class cache
        if (isset($tables[$key])) {
            $baseTable = $tables[$key];
            $table->copyTable($baseTable);
        }
        
        return $table;
    }
    
    /**
     * Get table columns
     * @param Table $table
     * @return TableColumn[]
     */
    function dbGetTableColumns(Table $table)
    {
        $columns = $table->getColumns();
        
        if (empty($columns)) {
            $input = new InputForSelect();
            $input->sql = <<<SQL
SELECT *
FROM information_schema.columns c
WHERE c.table_schema = ?
  AND c.table_name   = ?
-- AND c.table_catalog = '[dbname]'
ORDER BY c.ordinal_position;
SQL;
            $input->parameters = [
                $table->getSchemaName(), $table->getName()
            ];
            $output = $this->dbSelect($input);
            $columns = $output->rows;
            $table->resetColumns();
            foreach($columns as $column) {
                $table->addColumn($column);
            }
        }
        
        return $columns;
    }
    
    /**
     * Create table
     * 
     * @param Table $table
     * @return bool
     * 
     * @see http://www.postgresql.org/docs/9.5/static/sql-createtable.html
     */
    function dbCreateTable(Table $table)
    {
        //TODO: implement
        throw new Exception(__METHOD__ . ' not implemented yet');
    }
}
