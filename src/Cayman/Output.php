<?php
/**
 * File for Output interface
 */

namespace Cayman;

/**
 * Interface for Output
 *
 */
class Output
{
    
    const STATUS_SUCCESS = 'success';
    const STATUS_ERROR   = 'error';
    
    /**
     * Status
     * @var string
     */
    public $status;
    
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
     * Append error
     * @param Error  $row
     * @param string $key
     * @return void
     */
    public function appendError(Error $row, $key = null)
    {
        $this->status   = Output::STATUS_ERROR;
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
     * @var array
     */
    public $output = [];
    
    /**
     * Set output
     * @param mixed $output
     * @return void
     */
    public function setOutput($output)
    {
        $this->output = $output;
    }
    
    /**
     * Append data row
     * @param mixed  $row
     * @param string $key
     * @return void
     */
    public function appendOutput($row, $key = null)
    {
        if (is_null($key)) {
            $this->output[] = $row;
        } else {
            $this->output[$key] = $row;
        }
    }
    
}
