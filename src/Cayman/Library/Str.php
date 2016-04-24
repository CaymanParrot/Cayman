<?php

/**
 * File for String class
 */

namespace Cayman\Library;

/**
 * Class for String functions
 *
 */
class Str
{
    
    static function left($str, $left)
    {
        return mb_substr($str, 0, $left);
    }
    
    static function right($str, $right)
    {
        return mb_substr($str, - $right);
    }
    
    static function length($str)
    {
        return mb_strlen($str);
    }
    
    /**
     * Strip tags that we do not allow
     * 
     * @param string $text
     * @param string $allowableTags
     * @return string
     */
    static function stripTags($text, $allowableTags = null)
    {
        $secureText = strip_tags($text, $allowableTags);
        
        return $secureText;
    }
}
