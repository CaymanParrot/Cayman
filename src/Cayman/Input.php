<?php
/**
 * File for Input interface
 */

namespace Cayman;

/**
 * Interface for Input
 *
 * Format: '/module/service/action'
 * 
 * e.g. Bespoke 'GET /api/ecommerce/order/retrieve?input[id]=1234'
 * e.g. RESTful 'GET /api/ecommerce/orders/1234'
 */
class Input
{
    /**
     * Service name
     * @var string
     */
    public $service;
    
    /**
     * Action name
     * @var string
     */
    public $action;
    
    /**
     * Context ID
     * @var int
     */
    public $context_id;
    
    /**
     * Data
     * @var array
     */
    public $data = [];
    
    /**
     * Set service name
     * @param string $service
     * @var string
     */
    function setService($service)
    {
        $this->service = $service;
    }
    
    /**
     * Get service name
     * @var string
     */
    function getService()
    {
        return $this->service;
    }
    
    /**
     * Set action name
     * @param string $action
     */
    function setAction($action)
    {
        $this->action = $action;
    }
    
    /**
     * Get action name
     * @return string
     */
    function getAction()
    {
        return $this->action;
    }
    
    /**
     * Data to pass to a service
     * @param array $data
     * @var array
     */
    function setData(array $data)
    {
        $this->data = $data;
    }
    
    /**
     * Data to pass to a service
     * @var array
     */
    function getData()
    {
        return $this->data;
    }
    
    /**
     * Set context ID
     * @param int $contextId
     */
    function setContextId($contextId)
    {
        $this->context_id = $contextId;
    }
    
    /**
     * Get context ID
     * @return int
     */
    function getContextId()
    {
        return $this->context_id;
    }
}
