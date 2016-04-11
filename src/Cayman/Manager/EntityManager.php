<?php
/**
 * File for Entity Manager interface
 */

namespace Cayman\Manager;

use Cayman\Manager\DbManager\View;
use Cayman\Manager\DbManager\Row;

/**
 * Interface for Entity Manager
 */
interface EntityManager
{
    
    /**
     * Create entity
     * 
     * @param View $view
     * @param Row  $new
     * @return Row
     */
    function entityCreate(View $view, Row $new);
    
    /**
     * Update entity
     * 
     * @param View $view
     * @param Row  $new
     * @param Row  $old
     * @return Row
     */
    function entityUpdate(View $view, Row $new, Row $old);
    
    /**
     * Retrieve entity
     * 
     * @param View $view
     * @return Row
     */
    function entityRetrieve(View $view);
    
    /**
     * Select entities
     * 
     * @param View $view
     * @return Row[]
     */
    function entitySelect(View $view);
    
    /**
     * Delete entity
     * 
     * @param View $view
     * @param Row  $old
     * @return int number of deleted records
     */
    function entityDelete(View $view, Row $old);

}
