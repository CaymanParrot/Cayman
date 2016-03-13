<?php
/**
 * File for Container class
 */

namespace Cayman\Library;

/**
 * Class for Container
 * 
 * A kind of object interface to arrays
 * 
 */
class Container
{
    /**
     * Storage
     * @var array
     */
    protected $data = [];
    
    /**
     * Constructor
     * @param array $data
     */
    function __construct(array $data = [])
    {
        $this->data = $data;
    }
    
    /**
     * Get entry
     * @param string $key
     * @return mixed
     */
    function getEntry($key)
    {
        $data = $this->data;
        
        return isset($data[$key]) ? $data[$key] : [];
    }
    
    /**
     * Magic property setter
     * @param string $key
     * @param mixed  $val
     */
    function __set($key, $val)
    {
        $this->data[$key] = $val;
    }
    
    /**
     * Magic property checker
     * @param string $key
     * @return bool
     */
    function __isset($key)
    {
        return isset($this->data[$key]);
    }
    
    /**
     * Magic property unsetter
     * @param string $key
     */
    function __unset($key)
    {
        unset($this->data[$key]);
    }
    
    /**
     * Magic property getter
     * @param string $key
     * @return mixed
     */
    function __get($key)
    {
        $result = null;
        
        if (isset($this->data[$key])) {
            $result = $this->data[$key];
            if (is_array($result)) {//special case
                $result = new static($result);
            }
        }
        
        return $result;
    }
    
    /**
     * Get data as array
     * @return array
     */
    function toArray()
    {
        return $this->data;
    }
    
    /**
     * Get data as JSON string
     * @return string
     */
    function toJson()
    {
        return json_encode($this->data);
    }
}

