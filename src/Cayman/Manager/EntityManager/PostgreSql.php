<?php
/**
 * File for PostgreSQL 9.5 Entity Manager
 */

namespace Cayman\Manager\EntityManager;

use Cayman\Manager;
use Cayman\Manager\EntityManager;
use Cayman\Manager\DbManager\View;
use Cayman\Manager\DbManager\Row;
use Cayman\Manager\DbManager\InputForInsert;
use Cayman\Manager\DbManager\InputForUpdate;
use Cayman\Manager\DbManager\InputForDelete;
use Cayman\Manager\DbManager\InputForSelect;

/**
 * Class for PostgreSQL Database Entity Manager
 *
 */
class PostgreSql extends Manager implements EntityManager
{
    
    /**
     * Create entity
     * 
     * @param View $view
     * @param Row  $new
     * @return Row
     */
    function entityCreate(View $view, Row $new)
    {
        $newData = $new->toArray();
        $notNullData = [];
        foreach($newData as $key => $value) {
            if (! is_null($value)) {
                $notNullData[$key] = $value;
            }
        }
        
        $input = new InputForInsert();
        $input->tableName = $view->getName();
        $input->data      = $notNullData;
        $input->className = get_class($new);
        $output = $this->getDbManager()->dbInsert($input);
        $row = isset($output->rows[0]) ? $output->rows[0] : null;
        
        return $row;
    }
    
    /**
     * Update entity
     * 
     * @param View $view
     * @param Row  $new
     * @param Row  $old
     * @return Row
     */
    function entityUpdate(View $view, Row $new, Row $old)
    {
        $db = $this->getDbManager();
        
        $newData = $new->toArray();
        $oldData = $old->toArray();
        $changed = array_diff($newData, $oldData);
        
        $whereArr = [];
        foreach($view->getPrimaryKey() as $columnName) {
            $name = $view->getFullName() . '.' . $db->dbDelimit($columnName);
            $whereArr[] = $name . ' = ?';
        }
        $where = '(' . implode(') AND (', $whereArr) . ')';
        
        $input = new InputForUpdate();
        $input->tableName       = $view->getName();
        $input->data            = $changed;
        $input->where           = $where;
        $input->whereParameters = [ $oldData['id'] ];
        $input->className       = get_class($new);
        $output = $db->dbUpdate($input);
        $row = isset($output->rows[0]) ? $output->rows[0] : null;
        
        return $row;
    }
    
    /**
     * Retrieve entity
     * 
     * @param View $view
     * @return Row
     */
    function entityRetrieve(View $view)
    {
        $db = $this->getDbManager();
        
        $input = new InputForSelect();
        $input->sql        = $view->getSql();
        $input->parameters = $view->getParameters();
        $input->className  = $view->getRowClassName();
        $output = $db->dbSelect($input);
        $row = isset($output->rows[0]) ? $output->rows[0] : null;
        
        return $row;
    }
    
    /**
     * Select entities
     * 
     * @param View $view
     * @return Row[]
     */
    function entitySelect(View $view)
    {
        $db = $this->getDbManager();
        
        $input = new InputForSelect();
        $input->sql        = $view->getSql();
        $input->parameters = $view->getParameters();
        $input->className  = $view->getRowClassName();
        $output = $db->dbSelect($input);
        $rows = $output->rows;
        
        return $rows;
    }
    
    /**
     * Delete entity
     * 
     * @param View $view
     * @param Row  $old
     * @return int number of deleted records
     */
    function entityDelete(View $view, Row $old)
    {
        $db = $this->getDbManager();
        
        $input = new InputForDelete();
        $input->tableName       = $view->getName();
        $input->where           = $this->getWhereClauseFromPrimaryKey($view, $old);
        $input->whereParameters = $this->getWhereClauseParamsFromPrimaryKey($view, $old);
        $output = $db->dbDelete($input);
        
        return $output->rowCount;
    }
    
    /**
     * Get where clause from primary key
     * @param View $view
     * @return string
     */
    private function getWhereClauseFromPrimaryKey(View $view, Row $row)
    {
        $db = $this->getDbManager();
        
        $whereArr = [];
        foreach($view->getPrimaryKey() as $columnName) {
            $name = $view->getFullName() . '.' . $db->dbDelimit($columnName);
            $value = $row->$columnName;
            if ($value instanceof Manager\DbExpression) {
                $whereArr[] = $name . ' = ' . $value->value;
            } else {
                $whereArr[] = $name . ' = ?';
            }
        }
        $where = '(' . implode(') AND (', $whereArr) . ')';
        
        return $where;
    }
    
    /**
     * Get where clause parameters from primary key
     * @param View $view
     * @return array
     */
    private function getWhereClauseParamsFromPrimaryKey(View $view, Row $row)
    {
        $params = [];
        foreach($view->getPrimaryKey() as $columnName) {
            $value = $row->$columnName;
            if (! ($value instanceof Manager\DbExpression)) {
                $params[] = $row->$columnName;
            }
        }
        
        return $params;
    }
}
