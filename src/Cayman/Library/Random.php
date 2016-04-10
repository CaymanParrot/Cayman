<?php

/**
 * File for Random class
 */

namespace Cayman\Library;

/**
 * Class for some Randomness
 *
 */
class Random
{
    /**
     * Generate a random number
     * @param int $min
     * @param int $max
     * @return int
     */
    static function number($min = 0, $max = null)
    {
        mt_srand();
        if (is_null($max)) {
            $max = getrandmax();
        }
        $number = mt_rand($min, $max);
        
        return $number;
    }
    
    /**
     * Generate a random string using string domain
     * @param int    $length
     * @param string $stringDomain
     * @return string
     */
    static function stringUsingDomain($length, $stringDomain)
    {
        $string  = '';
        
        $domainLength = strlen($stringDomain);
        for ($i = 0; $i < $length; $i++) {
            $number  = static::number(0, $domainLength);
            $letter  = $stringDomain[$number];
            $string .= $letter;
        }
        
        return $string;
    }
    
    /**
     * Generate a random string using upper case letters
     * @param int $length
     * @return string
     */
    static function stringUpperCase($length)
    {
        $stringDomain = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = static::stringUsingDomain($length, $stringDomain);
        
        return $string;
    }
    
    /**
     * Generate a random string using upper case letters
     * @param int $length
     * @return string
     */
    static function stringLowerCase($length)
    {
        $stringDomain = 'abcdefghijklmnopqrstuvwxyz';
        $string = static::stringUsingDomain($length, $stringDomain);
        
        return $string;
    }
    
    /**
     * Generate a random string using upper/lower case letters
     * @param int $length
     * @return string
     */
    static function stringMixedCase($length)
    {
        $stringDomain = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = static::stringUsingDomain($length, $stringDomain);
        
        return $string;
    }
}
