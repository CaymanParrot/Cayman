<?php

/**
 * File for password class
 */

namespace My\Library;

/**
 * Class for password functions
 *
 */
class Password
{
    /**
     * Create a hash for password
     * @param string $password
     * @return string | false on failure
     * 
     * @see http://php.net/manual/en/function.password-hash.php
     */
    static function hash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    /**
     * Check whether the hash is generated for the given password or not
     * @param string $password
     * @param string $hash
     * @return bool
     * 
     * @see http://php.net/manual/en/function.password-verify.php
     */
    static function verify($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
