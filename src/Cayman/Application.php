<?php
/**
 * File for Application class
 */

namespace Cayman;

use Cayman\Manager\AssetManager;
use Cayman\Manager\CacheManager;
use Cayman\Manager\DbManager;
use Cayman\Manager\EmailManager;
use Cayman\Manager\EmailManager\Email;
use Cayman\Manager\EntityManager;
use Cayman\Manager\EventManager;
use Cayman\Manager\EventManager\EventContext;
use Cayman\Manager\FilterManager;
use Cayman\Manager\IdentityManager;
use Cayman\Manager\LocaleManager;
use Cayman\Manager\LogManager;
use Cayman\Manager\QueueManager;
use Cayman\Manager\ReleaseManager;

/**
 * Abstract class for Application
 * 
 * @method \PDO             getPdoManager($id = 'default')
 * @method \Redis           getRedisManager($id = 'default')
 * 
 * @method AssetManager     getAssetManager($id = 'default')
 * @method CacheManager     getCacheManager($id = 'default')
 * @method DbManager        getDbManager($id = 'default')
 * @method EmailManager     getEmailManager($id = 'default')
 * @method EntityManager    getEntityManager($id = 'default')
 * @method EventManager     getEventManager($id = 'default')
 * @method FilterManager    getFilterManager($id = 'default')
 * @method IdentityManager  getIdentityManager($id = 'default')
 * @method LocaleManager    getLocaleManager($id = 'default')
 * @method LogManager       getLogManager($id = 'default')
 * @method QueueManager     getQueueManager($id = 'default')
 * @method ReleaseManager   getReleaseManager($id = 'default')
 * 
 */
abstract class Application
{
    use SettingsTrait;
    
    /**
     * Array of managers loaded
     * @var Manager[]
     */
    private $managers = [];
    
    /**
     * Array of services loaded
     * @var Service[]
     */
    private $services = [];
    
    /**
     * Override to do special operations
     * @return void
     */
    function afterNewSettings()
    {
        //do something
    }
    
    /**
     * Magic call handler
     * @param string $name
     * @param array  $arguments
     * @return Manager
     */
    function __call($name, $arguments)
    {
        $result = null;
        
        if ('get' == substr($name, 0, 3)) {
            $type   = strtolower(substr($name, 3));
            
            if (stripos($type, 'manager') !== false) {
                $type   = str_replace('manager', '', $type);
                $id     = isset($arguments[0]) ? $arguments[0] : 'default';
                $result = $this->getManager($type, $id);
            }
            if (stripos($type, 'service') !== false) {
                $type   = str_replace('service', '', $type);
                $id     = isset($arguments[0]) ? $arguments[0] : 'default';
                $result = $this->getService($type, $id);
            }
        }
        
        return $result;
    }
    
    /**
     * Load manager
     * @param string $type
     * @param string $id
     * @return Manager
     * @throws Exception
     */
    function loadManager($type, $id = 'default')
    {
        $typeOriginal = $type;
        $type = strtolower($type);
        $managersArr = $this->getSettings()->getEntry('managers');
        if (empty($managersArr[$type])) {
            throw new Exception('Manager setting undefined type: ' . $type . ', id: ' . $id);
        }
        if (empty($managersArr[$type][$id])) {
            throw new Exception('Manager setting undefined type: ' . $type . ', id: ' . $id);
        }
        
        $managerArr  = $managersArr[$type][$id];
        if (empty($managerArr['factory']) or ! is_callable($managerArr['factory'])) {
            throw new Exception('Manager factory undefined type: ' . $type . ', id: ' . $id);
        }
        $factory    = $managerArr['factory'];
        $settingArr = isset($managerArr['settings']) ? $managerArr['settings'] : [];
        $settings   = new Settings($settingArr);
        $params     = [$this, $settings, $id];
        $manager    = call_user_func_array($factory, $params);// run manager factory * * *
        //if (!($manager instanceof Manager)) {
        //    throw new Exception('Invalid manager implementation: ' . $typeOriginal);
        //}
        $this->setManager($manager, $type, $id);
        
        return $manager;
    }
    
    /**
     * Set manager
     * @param Manager $manager
     * @param string  $type
     * @param string  $id
     * @return void
     */
    function setManager($manager, $type, $id)
    {
        $this->managers[$type][$id] = $manager;
    }
    
    /**
     * Get manager
     * @param string $type
     * @param string $id
     * @return Manager
     * @throws Exception
     */
    function getManager($type, $id = 'default')
    {
        if (empty($this->managers[$type][$id])) {
            $this->loadManager($type, $id);
        }
        if (empty($this->managers[$type][$id])) {
            throw new Exception('Manager undefined type: ' . $type . ', id: ' . $id);
        }
        return $this->managers[$type][$id];
    }
    
    /**
     * Load service
     * @param string $alias
     * @return Service
     * @throws Exception
     */
    function loadService($alias)
    {
        $className  = $this->getServiceClassName($alias);
        $serviceArr = $this->getSettings()->services->getEntry($alias);
        $settingArr = isset($serviceArr['settings']) ? $serviceArr['settings'] : [];
        $settings   = new Settings($settingArr);
        $service    = new $className();
        if (!($service instanceof Service)) {
            throw new Exception('Invalid service implementation: ' . $alias);
        }
        $service->setApp($this);
        $service->setSettings($settings);
        
        $this->setService($service, $alias);
        
        return $service;
    }
    
    function getServiceClassName($alias)
    {
        $appServices = $this->getSettings()->application->services;
        $namespace   = $appServices->namespace;
        if (empty($namespace)) {
            throw new Exception('Service namespace undefined');
        }
        $alias = substr($alias, 0, 1) == '/' ? substr($alias, 1) : $alias;
        $alias = strtolower($alias);
        $alias = preg_replace_callback(// '-abc' ==> 'Abc'
            '/[-](.)/',
            function ($matches) {
                return strtoupper($matches[1]);
            },
            $alias
        );
        $alias = preg_replace_callback(// '/abc' ==> '/Abc'
            '/[\/](.)/',
            function ($matches) {
                return '/'.strtoupper($matches[1]);
            },
            $alias
        );
        $alias     = str_replace('/', '\\', $alias);
        $className = $namespace . '\\' . $alias;
        // '/system/entity-type' ==> '\My\Application\Service\System\EntityType'
        
        return $className;
    }
    
    /**
     * Set service
     * @param Service $service
     * @param string  $alias
     * @return void
     */
    function setService(Service $service, $alias)
    {
        $this->services[$alias] = $service;
    }
    
    /**
     * Get service
     * @param string $alias
     * @return Manager
     * @throws Exception
     */
    function getService($alias)
    {
        if (empty($this->services[$alias])) {
            $this->loadService($alias);
        }
        if (empty($this->services[$alias])) {
            throw new Exception('Service undefined alias: ' . $alias);
        }
        return $this->services[$alias];
    }
    
    /**
     * Load input
     * @param array $serverData
     * @param array $input
     * @return Input
     */
    abstract function loadInput(array $serverData = [], array $input = []);
    
    /**
     * Run the application
     * @param AppInput $input
     * @return AppOutput
     */
    function run(AppInput $input)
    {
        $output = new AppOutput();
        $output->appendMeta(date('Y-m-d H:i:s'), 'now');
        $output->setInput($input);
        
        $serviceAlias = $input->getService();
        $actionName   = $input->getAction();
        
        $service = $this->loadService($serviceAlias);
        if (! method_exists($service, $actionName)) {
            throw new Exception('Invalid service call: ' . $actionName);
        }
        $serviceClassName  = $this->getServiceClassName($serviceAlias);
        $serviceInputClass = $serviceClassName . '\\' . ucfirst($actionName) . '\\Input';
        if (!class_exists($serviceInputClass)) {
            throw new Exception('Uknown service input class: ' . $serviceInputClass);
        }
        $serviceInput = new $serviceInputClass($input->data);
        $serviceOutput = $service->$actionName($serviceInput);
        $output->setOutput($serviceOutput);
        
        return $output;
    }
    
    /**
     * Log message using 'default' log manager or another
     * @param string $message
     * @param string $level
     * @param string $managerId
     * @return bool
     */
    function log($message, $level = 'info', $managerId = 'default')
    {
        return $this->getLogManager($managerId)->log($message, $level);
    }
    
    /**
     * Send email
     * @param Email  $email
     * @param string $managerId
     */
    function emailSend(Email $email, $managerId = 'default')
    {
        return $this->getEmailManager($managerId)->emailSend($email);
    }
    
    /**
     * Broadcast event
     * @param string       $eventName
     * @param EventContext $context
     * @param string       $managerId
     * @return void
     */
    function event($eventName, EventContext $context, $managerId = 'default')
    {
        return $this->getEventManager($managerId)->eventBroadcast($eventName, $context);
    }
    
    /**
     * Get help
     * @param Input $input
     * @return Output
     */
    function help(Input $input)
    {
        //TODO: implement
    }
    
}
