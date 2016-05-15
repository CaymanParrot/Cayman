<?php
/**
 * File for base application output class
 */

namespace Cayman;

/**
 * Class for base application output
 *
 */
class AppOutput
{
    use Library\ObjectDeHydratorTrait;
    
    const STATUS_SUCCESS = 'success';
    const STATUS_ERROR   = 'error';
    
    /**
     * Status
     * @var string
     */
    public $status = 'success';
    
    /**
     * Set status
     * @param string $status
     * @return void
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
    
    /**
     * Set status
     * @param string $status
     * @return void
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * Array of error messages
     * @var array 
     */
    public $errors = [];
    
    /**
     * Append error
     * @param Error  $row
     * @param string $key
     * @return void
     */
    public function appendError(Error $row, $key = null)
    {
        $this->status = static::STATUS_ERROR;
        if (is_null($key)) {
            $this->errors[] = $row;
        } else {
            $this->errors[$key] = $row;
        }
    }
    
    /**
     * Array of meta information
     * @var array
     */
    public $meta = [];
    
    /**
     * Append meta
     * @param mixed  $row
     * @param string $key
     * @return void
     */
    public function appendMeta($row, $key = null)
    {
        if (is_null($key)) {
            $this->meta[] = $row;
        } else {
            $this->meta[$key] = $row;
        }
    }
    
    /**
     * Array of data
     * @var array
     */
    public $input = [];
    
    /**
     * Set input
     * @param mixed $input
     * @return void
     */
    public function setInput($input)
    {
        $this->input = $input;
    }
    
    /**
     * Append data row
     * @param mixed  $row
     * @param string $key
     * @return void
     */
    public function appendInput($row, $key = null)
    {
        if (is_null($key)) {
            $this->input[] = $row;
        } else {
            $this->input[$key] = $row;
        }
    }
    
    /**
     * Array of data
     * @var ServiceOutput
     */
    public $output;
    
    /**
     * Set output
     * @param ServiceOutput $output
     * @return void
     */
    public function setOutput(ServiceOutput $output)
    {
        $this->output = $output;
    }
    
}
