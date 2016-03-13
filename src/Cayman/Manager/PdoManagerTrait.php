<?php
/**
 * File for PDO Manager trait
 */

namespace Cayman\Manager;

use Cayman\ExceptionManagerUndefined;

/**
 * Trait for PDO Manager
 *
 */
trait PdoManagerTrait
{
    
    /**
     * PDO Manager object
     * @var \PDO
     */
    private $pdoManager;
    
    /**
     * Set PDO Manager
     * @param \PDO $pdoManager
     * @return void
     */
    function setPdoManager(\PDO $pdoManager)
    {
        $this->pdoManager = $pdoManager;
    }
    
    /**
     * Get PDO Manager
     * @return \PDO
     */
    function getPdoManager()
    {
        if (empty($this->pdoManager)) {
            $manager = $this->getManager('pdo');//try to load it using app
            if (empty($manager)) {
                throw new ExceptionManagerUndefined('PDO manager undefined');
            }
        }
        
        return $this->pdoManager;
    }

}
