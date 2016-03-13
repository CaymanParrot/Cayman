<?php
/**
 * File for PDO trait
 */

namespace Cayman\Manager;

use Cayman\ExceptionManagerUndefined;

/**
 * Trait for PDO
 *
 */
trait PdoTrait
{
    
    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;
    
    /**
     * Set PDO
     * @param \PDO $pdo
     * @return void
     */
    function setPdo(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    /**
     * Get PDO
     * @return \PDO
     */
    function getPdo()
    {
        if (empty($this->pdo)) {
            $manager = $this->getManager('pdo');//try to load it using app
            if (empty($manager)) {
                throw new ExceptionManagerUndefined('PDO connection undefined');
            }
        }
        
        return $this->pdo;
    }

}
