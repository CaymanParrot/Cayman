<?php
/**
 * File for autoloading Cayman classes
 */

spl_autoload_register(
    function($className) {
        $dir = __DIR__;
        $ds = DIRECTORY_SEPARATOR;
        if (substr($className, 0, 6) == 'Cayman') {
            $className = substr($className, 7);//drop 7 chars 'Cayman\'
            $className = str_replace('\\', $ds, $className);//  '\' ==> '/'
            $file = $dir . $ds . $className . '.php';
            if (file_exists($file)) {
                require_once $file;
            }
        }
    }
);
