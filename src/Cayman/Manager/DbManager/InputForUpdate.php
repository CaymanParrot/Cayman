<?php

/**
 * File for input class of update function of db manager
 */

namespace Cayman\Manager\DbManager;

/**
 * Class for input of update function of db manager
 *
 */
class InputForUpdate
{
    /**
     * Table name
     * @var string
     */
    public $tableName;
    
    /**
     * Data array
     * @var array
     */
    public $data = [];
    
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
    
    /**
     * Field names to be included in row returned
     * @var string
     */
    public $returnFieldNames = '*';
    
    /**
     * Class name of row returned
     * @var string
     */
    public $className;
}
