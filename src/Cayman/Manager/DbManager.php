<?php
/**
 * File for Database Manager interface
 */

namespace Cayman\Manager;

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
 * Interface for Database Manager
 */
interface DbManager
{
    
    /**
     * Delimit name e.g. table name, field name, etc.
     * @param string $name
     * @return string
     */
    function dbDelimit($name);
    
    /**
     * Begin transaction
     * @return bool
     */
    function dbBeginTransaction();
    
    /**
     * Commit transaction
     * @return bool
     */
    function dbCommitTransaction();
    
    /**
     * Rollback transaction
     * @return bool
     */
    function dbRollbackTransaction();
    
    /**
     * Execute query and return statement object
     * 
     * @param InputForStatement $input
     * @return OutputForStatement
     */
    function dbStatement(InputForStatement $input);

    /**
     * Execute query and return records as instance of class given
     * 
     * @param InputForSelect $input
     * @return OutputForSelect
     */
    function dbSelect(InputForSelect $input);
    
    /**
     * Insert record
     * 
     * @see http://www.postgresql.org/docs/9.5/static/sql-insert.html
     * 
     * @param InputForInsert $input
     * @return OutputForInsert
     */
    function dbInsert(InputForInsert $input);
    
    /**
     * Update record
     * 
     * @param InputForUpdate $input
     * @return OutputForUpdate
     */
    function dbUpdate(InputForUpdate $input);
    
    /**
     * Delete record
     * 
     * @param InputForDelete $input
     * @return OutputForDelete
     */
    function dbDelete(InputForDelete $input);
    
}
