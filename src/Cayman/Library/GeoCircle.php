<?php

/**
 * File for GeoCircle shape
 */

namespace My\Library;

/**
 * Class for GeoCircle
 *
 */
class GeoCircle extends GeoShape
{
    /**
     * Type of shape
     * @var string
     */
    public $type = 'circle';
    
    /**
     * Centre of circle
     * @var GeoPoint
     */
    public $centre;
    
    /**
     * Radius in miles
     * @var float
     */
    public $radius;
}
