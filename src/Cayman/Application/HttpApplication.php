<?php
/**
 * File for HTTP Application class
 */

namespace Cayman\Application;

use Cayman\Application;
use Cayman\Exception;
use Cayman\AppInput;
use Cayman\AppOutput;

/**
 * Class for HTTP Application
 * 
 */
class HttpApplication extends Application
{
    /**
     * Server data - set after using loadInput()
     * @var array
     */
    protected $serverData = [];
    
    /**
     * Load input
     * @param array $serverData
     * @param array $inputData
     * @return Input
     */
    function loadInput(array $serverData = [], array $inputData = [])
    {
        $this->serverData = $serverData;
        
        $input = new AppInput();
        $input->setData($inputData);
        
        $apiPrefix = $this->getSettings()->application->api_prefix;
        $apiPrefix = !empty($apiPrefix) && is_string($apiPrefix) ? $apiPrefix : '';// '/api/v1'
        
        $qryStr  = strtolower($serverData['QUERY_STRING']);  // e.g. 'a=b&c=d'
        $method  = strtolower($serverData['REQUEST_METHOD']);// e.g. 'GET'
        $uri     = strtolower($serverData['REQUEST_URI']);   // e.g. '/api/v1/account/user/index'
        if ($uri == '/') {
            $uri = $apiPrefix . '/index/index';//default entry point
        }
        $uri = str_replace([$qryStr, '?'], '', $uri);//remove parameters and '?'
        
        $apiPrefixLen = strlen($apiPrefix);
        if (substr($uri, 0, $apiPrefixLen) == $apiPrefix) {// starts with same prefix
            $uri = substr($uri, $apiPrefixLen);//take the rest
        }
        
        do {
            // custom /module/service/action/UUID
            if ($matches   = $this->matchModuleServiceActionUuid($uri)){
                $command   = $matches['module'] . '/' . $matches['service'];
                $action    = $matches['action'];
                $contextId = $matches['uuid'];
                break;
            }
            // custom /module/service/action/INTEGER
            if ($matches   = $this->matchModuleServiceActionInt($uri)){
                $command   = $matches['module'] . '/' . $matches['service'];
                $action    = $matches['action'];
                $contextId = $matches['integer'];
                break;
            }
            // custom /service/action
            if ($matches   = $this->matchServiceAction($uri)){
                $command   = $matches['service'];
                $action    = $matches['action'];
                break;
            }
            
            switch ($method) {
                case 'get':
                    // get /module/service/UUID retrieve
                    if ($matches   = $this->matchModuleServiceUuid($uri)){
                        $command   = $matches['module'] . '/' . $matches['service'];
                        $action    = 'retrieve';
                        $contextId = $matches['uuid'];
                        break;
                    }
                    // get /module/service/INT retrieve
                    if ($matches   = $this->matchModuleServiceInt($uri)){
                        $command   = $matches['module'] . '/' . $matches['service'];
                        $action    = 'retrieve';
                        $contextId = $matches['integer'];
                        break;
                    }
                    // get custom /module/service/action
                    if ($matches = $this->matchModuleServiceAction($uri)){
                        $command = $matches['module'] . '/' . $matches['service'];
                        $action  = $matches['action'];
                        break;
                    }
                    // get custom /module/service index
                    if ($matches = $this->matchModuleService($uri)){
                        $command = $matches['module'] . '/' . $matches['service'];
                        $action  = 'index';
                        break;
                    }
                    throw new Exception('Invalid get request');
                case 'post':
                    // post custom /module/service/action
                    if ($matches = $this->matchModuleServiceAction($uri)){
                        $command = $matches['module'] . '/' . $matches['service'];
                        $action  = $matches['action'];
                        break;
                    }
                    // post /module/service create
                    if ($matches = $this->matchModuleService($uri)){
                        $command = $matches['module'] . '/' . $matches['service'];
                        $action  = 'create';
                        break;
                    }
                    throw new Exception('Invalid post request');
                case 'put':
                    // put /module/service/UUID update
                    if ($matches   = $this->matchModuleServiceUuid($uri)){
                        $command   = $matches['module'] . '/' . $matches['service'];
                        $action    = 'update';
                        $contextId = $matches['uuid'];
                        break;
                    }
                    // put /module/service/INTEGER update
                    if ($matches   = $this->matchModuleServiceInt($uri)){
                        $command   = $matches['module'] . '/' . $matches['service'];
                        $action    = 'update';
                        $contextId = $matches['integer'];
                        break;
                    }
                    throw new Exception('Invalid put request');
                case 'delete':
                    // delete /module/service/UUID
                    if ($matches   = $this->matchModuleServiceUuid($uri)){
                        $command   = $matches['module'] . '/' . $matches['service'];
                        $action    = 'delete';
                        $contextId = $matches['uuid'];
                        break;
                    }
                    // delete /module/service/INTEGER
                    if ($matches   = $this->matchModuleServiceInt($uri)){
                        $command   = $matches['module'] . '/' . $matches['service'];
                        $action    = 'delete';
                        $contextId = $matches['integer'];
                        break;
                    }
                    throw new Exception('Invalid delete request');
            }
        } while(false);//run once
        
        $input->setService($command);
        $input->setAction($action);
        
        if (isset($contextId)) {
            $input->setContextId($contextId);
        }
        
        return $input;
    }
    
    const PATTERN_BASE_UUID     = '\w{8}-\w{4}-\w{4}-\w{4}-\w{12}';// 8chars-4chars-4chars-4chars-12chars
    const PATTERN_BASE_ALPHANUM = '[a-z]+[a-z0-9\-]+';// starts with a letter, a word
    const PATTERN_BASE_DIGITS   = '[0-9]+';

    const PATTERN_MODULE  = '(?P<module>'  . self::PATTERN_BASE_ALPHANUM . ')';
    const PATTERN_SERVICE = '(?P<service>' . self::PATTERN_BASE_ALPHANUM . ')';
    const PATTERN_ACTION  = '(?P<action>'  . self::PATTERN_BASE_ALPHANUM . ')';
    const PATTERN_UUID    = '(?P<uuid>'    . self::PATTERN_BASE_UUID     . ')';
    const PATTERN_INTEGER = '(?P<integer>' . self::PATTERN_BASE_DIGITS   . ')';
    
    /**
     * Match /Module/Service/Action/Uuid
     * @param string $uri
     * @return array | null
     */
    protected function matchModuleServiceActionUuid($uri)
    {
        $result  = null;
        $matches = [];
        $pattern = sprintf('@^/%s/%s/%s/%s$@', self::PATTERN_MODULE, self::PATTERN_SERVICE, self::PATTERN_ACTION, self::PATTERN_UUID);
        if (preg_match($pattern, $uri, $matches)) {
            $result = $matches;
        }
        return $result;
    }
    
    /**
     * Match /Module/Service/Uuid
     * @param string $uri
     * @return array | null
     */
    protected function matchModuleServiceUuid($uri)
    {
        $result  = null;
        $matches = [];
        $pattern = sprintf('@^/%s/%s/%s$@', self::PATTERN_MODULE, self::PATTERN_SERVICE, self::PATTERN_UUID);
        if (preg_match($pattern, $uri, $matches)) {
            $result = $matches;
        }
        return $result;
    }
    
    /**
     * Match /Module/Service/Action
     * @param string $uri
     * @return array | null
     */
    protected function matchModuleServiceAction($uri)
    {
        $result  = null;
        $matches = [];
        $pattern = sprintf('@^/%s/%s/%s$@', self::PATTERN_MODULE, self::PATTERN_SERVICE, self::PATTERN_ACTION);
        if (preg_match($pattern, $uri, $matches)) {
            $result = $matches;
        }
        return $result;
    }
    
    /**
     * Match /Module/Service/Action/Integer
     * @param string $uri
     * @return array | null
     */
    protected function matchModuleServiceActionInt($uri)
    {
        $result  = null;
        $matches = [];        
        $pattern = sprintf('@^/%s/%s/%s/%s$@', self::PATTERN_MODULE, self::PATTERN_SERVICE, self::PATTERN_ACTION, self::PATTERN_INTEGER);
        if (preg_match($pattern, $uri, $matches)) {
            $result = $matches;
        }
        return $result;
    }
    
    /**
     * Match /Module/Service/Integer
     * @param string $uri
     * @return array | null
     */
    protected function matchModuleServiceInt($uri)
    {
        $result  = null;
        $matches = [];        
        $pattern = sprintf('@^/%s/%s/%s$@', self::PATTERN_MODULE, self::PATTERN_SERVICE, self::PATTERN_INTEGER);
        if (preg_match($pattern, $uri, $matches)) {
            $result = $matches;
        }
        return $result;
    }
    
    /**
     * Match /Module/Service - assume default action
     * @param string $uri
     * @return array | null
     */
    protected function matchModuleService($uri)
    {
        $result  = null;
        $matches = [];        
        $pattern = sprintf('@^/%s/%s$@', self::PATTERN_MODULE, self::PATTERN_SERVICE);
        if (preg_match($pattern, $uri, $matches)) {
            $result = $matches;
        }
        return $result;
    }
    
    /**
     * Match /Service/Action
     * @param string $uri
     * @return array | null
     */
    protected function matchServiceAction($uri)
    {
        $result  = null;
        $matches = [];
        $pattern = sprintf('@^/%s/%s$@', self::PATTERN_SERVICE, self::PATTERN_ACTION);
        if (preg_match($pattern, $uri, $matches)) {
            $result = $matches;
        }
        return $result;
    }
    
    /**
     * The name of the server host under which the current script is executing. If the script is running on a
     * virtual host, this will be the value defined for that virtual host.
     * 
     * BUT https://www.example.com may be handled by http://example.com
     * This function will give us example.com
     * 
     * @example return value 'www.example.com'
     * 
     * @return string
     * @see http://php.net/manual/en/reserved.variables.server.php
     */    
    function getHttpServerDomainName()
    {
        $result = isset($this->serverData['SERVER_NAME']) ? $this->serverData['SERVER_NAME'] : null;
        
        return $result;
    }
    
    /**
     * Contents of the Host: header from the current request, if there is one.
     * 
     * BUT https://www.example.com may be handled by http://example.com
     * This function will give us www.example.com, though it can be tampered
     * 
     * @example return value 'www.example.com'
     * 
     * @return string
     * @see http://php.net/manual/en/reserved.variables.server.php
     */    
    function getHttpHostDomainName()
    {
        $result = isset($this->serverData['HTTP_HOST']) ? $this->serverData['HTTP_HOST'] : null;
        
        return $result;
    }
    
    /**
     * The IP address from which the user is viewing the current page.
     * @return string
     * @see http://php.net/manual/en/reserved.variables.server.php
     */    
    function getHttpClientIpAddress()
    {
        $result = null;
        
        $lookupKeys = [
            'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR',
        ];
        $flagNoPrivateIpAccepted = FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE;
        foreach ($lookupKeys as $key){
            if (array_key_exists($key, $this->serverData) === true){
                $ipList = explode(',', $this->serverData[$key]);
                foreach ($ipList as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, $flagNoPrivateIpAccepted) !== false){
                        $result = $ip;
                        break 2;//exit both loops
                    }
                }
            }
        }
        
        return $result;
    }
    
    
}