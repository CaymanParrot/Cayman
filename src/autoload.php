<?php
/**
 * File for autoloading Cayman classes
 */

spl_autoload_register(
    function($className) {
        $ds = DIRECTORY_SEPARATOR;
        if (substr($className, 0, 6) == 'Cayman') {
            $className = str_replace('\\', $ds, $className);//  '\' ==> '/'
            $file = __DIR__ . $ds . $className . '.php';
            if (file_exists($file)) {
                require $file;
            }
        }
    }
);
