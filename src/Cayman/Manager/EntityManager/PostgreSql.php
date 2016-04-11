<?php
/**
 * File for PostgreSQL 9.5 Entity Manager
 */

namespace Cayman\Manager\DbManager;

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
        $input = new InputForInsert();
        $input->tableName = $view->getName();
        $input->data      = $new->toArray();
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
        $newData = $new->toArray();
        $oldData = $old->toArray();
        $changed = array_diff($newData, $oldData);
        
        $input = new InputForUpdate();
        $input->tableName       = $view->getName();
        $input->data            = $changed;
        $input->where           = 'id = ?';
        $input->whereParameters = [ $oldData['id'] ];
        $input->className       = get_class($new);
        $output = $this->getDbManager()->dbUpdate($input);
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
        $input = new InputForSelect();
        $input->sql        = $view->getSql();
        $input->parameters = $view->getParameters();
        $input->className  = $view->getClassName();
        $output = $this->getDbManager()->dbSelect($input);
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
        $input = new InputForSelect();
        $input->sql        = $view->getSql();
        $input->parameters = $view->getParameters();
        $input->className  = $view->getClassName();
        $output = $this->getDbManager()->dbSelect($input);
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
        $oldData = $old->toArray();
        
        $input = new InputForDelete();
        $input->tableName       = $view->getName();
        $input->where           = 'id = ?';
        $input->whereParameters = [ $oldData['id'] ];
        $output = $this->getDbManager()->dbDelete($input);
        
        return $output->rowCount;
    }
}
