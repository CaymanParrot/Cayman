<?php

/**
 * File for input class for delete function of db manager
 */

namespace Cayman\Manager\DbManager;

/**
 * Class for input of delete function of db manager
 *
 */
class InputForDelete
{
    /**
     * Table name
     * @var string
     */
    public $tableName;
    
    /**
     * Where clause
     * @var string
     */
    public $where;
    
    /**
     * Parameter array for where clause
     * @var array
     */
    public $whereParameters = [];
}
