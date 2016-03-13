<?php
/**
 * File for PDO Manager class
 */

namespace Cayman\Manager;

use Cayman\Application;
use Cayman\Settings;

/**
 * Class for PDO Manager
 *
 */
class PdoFactory
{
    /**
     * Create a new PDO instance
     * @param Application $app
     * @param Settings    $settings
     * @param string      $id
     * @return \PDO
     */
    static function newPdo(Application $app, Settings $settings, $id = 'default')
    {
        $dsn      = $settings->dsn;
        $username = $settings->username;
        $password = $settings->password;
        
        $pdo = new \PDO($dsn, $username, $password);
        
        $app->setPdo($pdo, $id);
        
        return $pdo;
    }
}
