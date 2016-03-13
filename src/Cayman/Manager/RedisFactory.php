<?php
/**
 * File for Redis Factory class
 */

namespace Cayman\Manager;

use Cayman\Application;
use Cayman\Settings;

/**
 * Class for Redis Factory
 *
 */
class RedisFactory
{
    /**
     * Create a new Redis instance
     * @param Application $app
     * @param Settings    $settings
     * @param string      $id
     * @return \Redis
     */
    static function newRedis(Application $app, Settings $settings, $id = 'default')
    {
        $servers = $settings->servers;
        
        $redis = new \Redis();
        //TODO: initialize Redis
        //$redis->connect();
        
        $app->setRedis($redis, $id);
        
        return $redis;
    }
}
