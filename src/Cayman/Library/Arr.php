<?php

/**
 * File for Array class
 */

namespace Cayman\Library;

/**
 * Class for Array functions
 *
 */
class Arr
{
    /**
     * Sort array of objects by field
     * @param array  $array
     * @param string $idField
     * @param string $sortField
     * @param binary $sortFlags Default is SORT_NATURAL
     * @return array
     */
    public function sortArrayOfObjectsByField($array, $idField = 'id', $sortField = 'name', $sortFlags = null)
    {
        $result = [];
        
        if (! empty($array)) {
            $objectByIdArr = [];
            $fieldByIdArr  = [];
            foreach($array as $obj) {
                $id = $obj->$idField;
                $objectByIdArr[$id] = $obj;
                $val = strtolower($obj->$sortField);
                $fieldByIdArr[$id] = $val;
            }
            $sortFlags = $sortFlags ? $sortFlags : SORT_NATURAL;
            asort($fieldByIdArr);
            foreach($fieldByIdArr as $id => $val) {
                $result[] = $objectByIdArr[$id];
            }
        }
        
        return $result;
    }
    
    /**
     * Filter array of objects by callback function
     * @param array    $array
     * @param callable $callback should receive object 
     *    and return true or false in order
     * @return array
     */
    public function filterArrayOfObjectsByCallback($array, callable $callback)
    {
        $result = [];
        
        if (! empty($array)) {
            foreach($array as $obj) {
                if ($callback($obj)) {
                    $result[] = $obj;
                }
            }
        }
        
        return $result;
    }
    
    /**
     * Filter array of objects by field value
     * @param array  $array
     * @param string $field_name
     * @param mixed  $value
     * @return array
     */
    public function filterArrayOfObjectsByFieldValue($array, $field_name, $value)
    {
        $result = $this->filterArrayOfObjectsByCallback(
            $array,
            function($obj) use ($field_name, $value) {
                return ($obj->$field_name === $value);
            }
        );
        
        return $result;
    }
    
    /**
     * Convert object to array
     * @param mixed $obj Object, scalar value, array, null
     * @return array
     */
    static function toArray($obj)
    {
        $result = [];
        
        if (is_null($obj)) {
            $result = null;
        } elseif (is_scalar($obj)) {
            $result = $obj;
        } elseif (is_object($obj)) {
            if (method_exists($obj, 'toArray')) {
                $data = $obj->toArray();
            } else {
                $data = (array) $obj;
            }
            $result = static::toArray($data);
        } elseif (is_array($obj)){
            foreach ($obj as $key => $value) {
                $result[$key] = static::toArray($value);
            }
        }
        
        return $result;
    }
}
