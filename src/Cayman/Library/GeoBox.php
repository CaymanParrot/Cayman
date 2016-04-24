<?php

/**
 * File for GeoBox shape
 */

namespace My\Library;

/**
 * Class for GeoBox
 *
 */
class GeoCircle extends GeoShape
{
    /**
     * Type of shape
     * @var string
     */
    public $type = 'box';
    
    /**
     * Top left point
     * @var GeoPoint
     */
    public $top_left;
    
    /**
     * Bottom right point
     * @var GeoPoint
     */
    public $bottom_right;
}
