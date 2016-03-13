<?php
/**
 * Sample file for HTTP application settings
 */

// All factory entries can be replaced with a callable or an anonymous/lambda function
// All dependencies are references to other managers/services

return [
    
    'application' => [
        'name'       => 'Example',
        'version'    => 'v1.0',
        'api_url'    => 'https://api.example.com',
        'api_prefix' => '/api/v1',
        'app_url'    => 'https://app.example.com',
        'services'   => [
            'namespace' => '\\Example\\Application\\Service',
        ],
    ],
    
    'services' => [
        
    ],
    
    'managers' => [
        
//        'type' => [
//            'default' => [// ID of manager, there can be multiple instances of same type of manager
//                'factory'  => '\\Namespace\\Manager-Class::newManager',// any callable
//                'settings' => [
//                    'managers' => [// dependency references
//                        'another-type' => 'default',// ID of other manager with type as key
//                        // by default any manager can use 'default' instance of any other manager
//                    ],
//                ],
//            ],
//        ],
        
        'asset' => [
            'default' => [
                'factory'  => '\\Cayman\\Manager\\AssetManager\\LocalDisk::newManager',
                'settings' => [
                    'path' => '/home/ubuntu/example/assets/',
                    'url'  => 'https://app.example.com/assets/',
                ],
            ],
        ],
        
        'cache' => [
            'default' => [
                'factory'  => '\\Cayman\\Manager\\CacheManager\\Redis::newManager',
                'settings' => [
                    'default_life_time' => 300, // seconds
                ],
            ],
        ],

        'db' => [
            'default' => [
                'factory'  => '\\Cayman\\Manager\\DbManager\\PostgreSql::newManager',
            ],
        ],
        
        'dbschema' => [
            'default' => [
                'factory'  => '\\Cayman\\Manager\\DbSchemaManager\\PostgreSql::newManager',
            ],
        ],
        
        'email' => [
            'default' => [
                'factory'  => '\\Cayman\\Manager\\EmailManager\\PhpMail::newManager',
                'settings' => [
                    'from_email' => '',
                    'from_name'  => '',
                ],
            ],
        ],
        
        'entity' => [
            'default' => [
                'factory'  => '\\Cayman\\Manager\\EntityManager\\PostgreSql::newManager',
                'settings' => [

                ],
            ],
        ],
        
        'event' => [
            'default' => [
                'factory'  => '\\Cayman\\Manager\\EventManager\\SimpleEventManager::newManager',
                'settings' => [

                ],
            ],
        ],
        
        'filter' => [
            'default' => [
                'factory'  => '\\Cayman\\Manager\\FilterManager\\PhpFilter::newManager',
                'settings' => [

                ],
            ],
        ],
        
        'identity' => [
            'default' => [
                'factory'  => '\\Cayman\\Manager\\IdentityManager\\DbIdentityManager::newManager',
                'settings' => [

                ],
            ],
        ],
        
        'locale' => [
            'default' => [
                'factory'  => '\\Cayman\\Manager\\LocaleManager\\DbLocaleManager::newManager',
                'settings' => [

                ],
            ],
        ],

        'log' => [
            'default' => [
                'factory'  => '\\Cayman\\Manager\\LogManager\\PhpLog::newManager',
                'settings' => [
                    'file' => '/home/ubuntu/example/logs/'.date('Ymd').'.log',
                ],
            ],
        ],
        
        'pdo' => [
            'default' => [
                'factory'  => '\\Cayman\\Manager\\PdoFactory::newPdo',
                'settings' => [
                    'dsn'      => 'pgsql:host=127.0.0.1;port=5432;dbname=caymanparrotdb',
                    'username' => 'cayman',
                    'password' => 'P4rR0t',
                    //'charset'  => 'utf8',
                    //'timezone' => 'utc',
                ],
            ],
        ],
        
        'redis' => [
            'default' => [
                'factory'  => '\\Cayman\\Manager\\RedisFactory::newRedis',
                'settings' => [
                    'servers' => [
                        ['127.0.0.1'],
                    ],
                ],
            ],
        ],
        
        'queue' => [
            'default' => [
                'factory'  => '\\Cayman\\Manager\\QueueManager\\Redis::newManager',
                'settings' => [

                ],
            ],
        ],
        
    ],
];
