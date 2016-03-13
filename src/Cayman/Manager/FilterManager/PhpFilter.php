<?php

/**
 * File for PHP Filter Manager class
 */

namespace Cayman\Manager\FilterManager;

use Cayman\Exception;
use Cayman\Manager;
use Cayman\Manager\FilterManager;

/**
 * Class for PHP Filter manager
 *
 */
class PhpFilter extends Manager implements FilterManager
{
    /**
     * Filter one input
     * @param Input $input
     * @return mixed filtered input
     */
    function filter(Input $input)
    {
        $value = $input->value;
        
        if (! $input->required and is_null($value)) {
            return $value;
        }
        
        foreach($input->options as $option) {
            $filterName = $option->filterName;
            $errMsg     = $option->errorMessage;
            $params     = $option->params;
            $args       = array_merge([$value, $errMsg], $params);
            $filterFunc = [$this, 'filter' . $filterName];
            
            $value = call_user_func_array($filterFunc, $args);
        }
        
        return $value;
    }
    
    private function filterScalar($value, $errMsg)
    {
        $result = filter_var($value, FILTER_REQUIRE_SCALAR);
        if ($result === false) {
            throw Exception($errMsg);
        }
        
        return $result;
    }
    
    private function filterEmail($value, $errMsg)
    {
        $result = $this->filterScalar($value, $errMsg);
        $result = filter_var($result, FILTER_VALIDATE_EMAIL);
        if ($result === false) {
            throw Exception($errMsg);
        }
        
        return $result;
    }
    
    private function filterEmailArray($value, $errMsg)
    {
        $result = $this->filterArray($value, $errMsg);
        foreach($result as $key => $val) {
            $result[$key] = $this->filterEmail($val, $errMsg);
        }
        
        return $result;
    }
    
    private function filterUrl($value, $errMsg)
    {
        $result = $this->filterScalar($value, $errMsg);
        $result = filter_var($result, FILTER_VALIDATE_URL);
        if ($result === false) {
            throw Exception($errMsg);
        }
        
        return $result;
    }
    
    private function filterUrlArray($value, $errMsg)
    {
        $result = $this->filterArray($value, $errMsg);
        foreach($result as $key => $val) {
            $result[$key] = $this->filterUrl($val, $errMsg);
        }
        
        return $result;
    }
    
    private function filterArray($value, $errMsg)
    {
        $result = filter_var($value, FILTER_REQUIRE_ARRAY);
        if ($result === false) {
            throw Exception($errMsg);
        }
        
        return $result;
    }
    
    private function filterStringArray($value, $errMsg)
    {
        $result = $this->filterArray($value, $errMsg);
        foreach($result as $key => $val) {
            $result[$key] = $this->filterString($val, $errMsg);
        }
        
        return $result;
    }
    
    private function filterString($value, $errMsg)
    {
        $result = $this->filterScalar($value, $errMsg);
        $result = filter_var($result, FILTER_SANITIZE_STRING);//side-effect ***
        if ($result === false) {
            throw Exception($errMsg);
        }
        
        return $result;
    }
    
    private function filterFloat($value, $errMsg)
    {
        $result = $this->filterScalar($value, $errMsg);
        $result = filter_var($result, FILTER_VALIDATE_FLOAT);
        if ($result === false) {
            throw Exception($errMsg);
        }
        
        return $result;
    }
    
    private function filterFloatGreaterThan($value, $errMsg, $min)
    {
        $result = $this->filterFloat($value, $errMsg);
        if ($result < $min) {
            throw Exception($errMsg);
        }
        
        return $result;
    }
    
    private function filterFloatLessThan($value, $errMsg, $max)
    {
        $result = $this->filterFloat($value, $errMsg);
        if ($max < $result) {
            throw Exception($errMsg);
        }
        
        return $result;
    }
    
    private function filterFloatArray($value, $errMsg)
    {
        $result = $this->filterArray($value, $errMsg);
        foreach($result as $key => $val) {
            $result[$key] = $this->filterFloat($val, $errMsg);
        }
        
        return $result;
    }
    
    private function filterInteger($value, $errMsg, array $options = [])
    {
        $result = $this->filterScalar($value, $errMsg);
        $result = filter_var($result, FILTER_VALIDATE_INT, $options);
        if ($result === false) {
            throw Exception($errMsg);
        }
        
        return $result;
    }
    
    private function filterIntegerRange($value, $errMsg, $min_range, $max_range)
    {
        $result = $this->filterInteger($value, $errMsg, ['options' => ['min_range' => $min_range, 'max_range' => $max_range]]);
        
        return $result;
    }
    
    private function filterIntegerGreaterThan($value, $errMsg, $min_range)
    {
        $result = $this->filterInteger($value, $errMsg, ['options' => ['min_range' => $min_range]]);
        
        return $result;
    }
    
    private function filterIntegerLessThan($value, $errMsg, $max_range)
    {
        $result = $this->filterInteger($value, $errMsg, ['options' => ['max_range' => $max_range]]);
        
        return $result;
    }
    
    private function filterIntegerArray($value, $errMsg)
    {
        $result = $this->filterArray($value, $errMsg);
        foreach($result as $key => $val) {
            $result[$key] = $this->filterInteger($val, $errMsg);
        }
        
        return $result;
    }
    
    private function filterMatch($value, $errMsg, $regexp)
    {
        $result = $this->filterScalar($value, $errMsg);
        $options = [
            'options' => [
                'regexp'=> $regexp,
            ],
        ];
        $result = filter_var($result, FILTER_VALIDATE_REGEXP, $options);
        if ($result === false) {
            throw Exception($errMsg);
        }
        
        return $result;
    }
}
