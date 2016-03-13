<?php
/**
 * File for trait to dehydrate objects
 */

namespace Cayman\Library;

/**
 * Trait to dehydrate objects
 *
 */
trait ObjectDeHydratorTrait
{
    use ObjectPropertiesTrait;
    
    /**
     * Convert this object to array - exclude properties with NUNLL value
     * @return array
     */
    function toArray()
    {
        $data = [];
        
        $publicProperties = $this->getPublicProperties();
        
        foreach($publicProperties as $key) {
            $val = $this->$key;//read property value
            
            if (is_null($val)) {
                $data[$key] = null;
            } else {
                if (is_object($val) && method_exists($val, 'toArray')) {
                    $data[$key] = $val->toArray();
                } else {
                    $data[$key] = $val;
                }
            }
        }
        
        $data = json_decode(json_encode($data), $assoc = true);
        
        return $data;
    }
}
