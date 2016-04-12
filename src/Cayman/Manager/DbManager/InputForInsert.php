<?php
/**
 * File for input class of insert function of db manager
 */

namespace Cayman\Manager\DbManager;

/**
 * Class for input of insert function of db manager
 *
 */
class InputForInsert extends InputCommon
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
