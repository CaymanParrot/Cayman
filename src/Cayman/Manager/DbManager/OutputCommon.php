<?php

/**
 * File for common output class
 */

namespace Cayman\Manager\DbManager;

/**
 * Class for common output
 *
 */
class OutputCommon
{
    /**
     * Rows returned
     * @var array
     */
    public $rows = [];
    
    /**
     * Execution result: true/false
     * @var bool
     */
    public $result;
    
    /**
     * Number of affected rows
     * @var int
     */
    public $rowCount;
}
