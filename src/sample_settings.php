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
                'factory'  => '\\Cayman\\Manager\\CacheManager\\RedisCache::newManager',
                'settings' => [
                    'default_life_time' => 300, // seconds
                    'managers' => [
                        'redis' => 'default',
                    ],
                ],
            ],
        ],

        'db' => [
            'default' => [
                'factory'  => '\\Cayman\\Manager\\DbManager\\PostgreSql::newManager',
                'settings' => [
                    'managers' => [
                        'pdo' => 'default',
                    ]
                ]
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
                    'events' => [
                        // [before|after]:manager/[manager-type]/[manager-alias|*]/[event-name|*]
                        '*' => [
                            '\\My\\Application\\EventListener\\AllEvents::eventListen',
                        ],
                        
                        'before:*' => [
                            
                        ],
                        'after:*' => [
                            
                        ],
                        
                        'before:service/*' => [
                            
                        ],
                        'after:service/*' => [
                            
                        ],
                        
                        'before:manager/*' => [
                            
                        ],
                        'after:manager/*' => [
                            
                        ],
                        
                        'before:manager/db/default/*' => [
                            
                        ],
                        'after:manager/db/default/*' => [
                            
                        ],
                        
                        'before:manager/db/default/connect' => [
                            
                        ],
                        'after:manager/db/default/connect' => [
                            
                        ],
                        
                        'before:manager/asset/*' => [
                            '\\My\\Application\\EventListener\\AssetManagerEvents::eventListen',
                        ],
                        'after:manager/asset/*' => [
                            '\\My\\Application\\EventListener\\AssetManagerEvents::eventListen',
                        ],

                        'before:manager/cache/*' => [
                            '\\My\\Application\\EventListener\\CacheManagerEvents::eventListen',
                        ],
                        'after:manager/cache/*' => [
                            '\\My\\Application\\EventListener\\CacheManagerEvents::eventListen',
                        ],

                        'before:manager/db/*' => [
                            '\\My\\Application\\EventListener\\DbManagerEvents::eventListen',
                        ],
                        'after:manager/db/*' => [
                            '\\My\\Application\\EventListener\\DbManagerEvents::eventListen',
                        ],

                        'before:manager/dbschema/*' => [
                            '\\My\\Application\\EventListener\\DbSchemaManagerEvents::eventListen',
                        ],
                        'after:manager/dbschema/*' => [
                            '\\My\\Application\\EventListener\\DbSchemaManagerEvents::eventListen',
                        ],

                        'before:manager/email/*' => [
                            '\\My\\Application\\EventListener\\EmailManagerEvents::eventListen',
                        ],
                        'after:manager/email/*' => [
                            '\\My\\Application\\EventListener\\EmailManagerEvents::eventListen',
                        ],

                        'before:manager/entity/*' => [
                            '\\My\\Application\\EventListener\\EntityManagerEvents::eventListen',
                        ],
                        'after:manager/entity/*' => [
                            '\\My\\Application\\EventListener\\EntityManagerEvents::eventListen',
                        ],

//                        'before:manager/event/*' => [
//                            '\\My\\Application\\EventListener\\EventManagerEvents::eventListen',
//                        ],
//                        'after:manager/event/*' => [
//                            '\\My\\Application\\EventListener\\EventManagerEvents::eventListen',
//                        ],

                        'before:manager/filter/*' => [
                            '\\My\\Application\\EventListener\\FilterManagerEvents::eventListen',
                        ],
                        'after:manager/filter/*' => [
                            '\\My\\Application\\EventListener\\FilterManagerEvents::eventListen',
                        ],

                        'before:manager/identity/*' => [
                            '\\My\\Application\\EventListener\\IdentityManagerEvents::eventListen',
                        ],
                        'after:manager/identity/*' => [
                            '\\My\\Application\\EventListener\\IdentityManagerEvents::eventListen',
                        ],

                        'before:manager/locale/*' => [
                            '\\My\\Application\\EventListener\\LocaleManagerEvents::eventListen',
                        ],
                        'after:manager/locale/*' => [
                            '\\My\\Application\\EventListener\\LocaleManagerEvents::eventListen',
                        ],

                        'before:manager/log/*' => [
                            '\\My\\Application\\EventListener\\LogManagerEvents::eventListen',
                        ],
                        'after:manager/log/*' => [
                            '\\My\\Application\\EventListener\\LogManagerEvents::eventListen',
                        ],

                        'before:manager/pdo/*' => [
                            '\\My\\Application\\EventListener\\PdoManagerEvents::eventListen',
                        ],
                        'after:manager/pdo/*' => [
                            '\\My\\Application\\EventListener\\PdoManagerEvents::eventListen',
                        ],

                        'before:manager/redis/*' => [
                            '\\My\\Application\\EventListener\\RedisManagerEvents::eventListen',
                        ],
                        'after:manager/redis/*' => [
                            '\\My\\Application\\EventListener\\RedisManagerEvents::eventListen',
                        ],

                        'before:manager/queue/*' => [
                            '\\My\\Application\\EventListener\\QueueManagerEvents::eventListen',
                        ],
                        'after:manager/queue/*' => [
                            '\\My\\Application\\EventListener\\QueueManagerEvents::eventListen',
                        ],
                    ]
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
