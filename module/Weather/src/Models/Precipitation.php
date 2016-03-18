<?php
/**
 * User: steve
 * Date: 16/03/16
 * Time: 08:33
 */

namespace Weather\Models;


class Precipitation
{

    /**
     * Precipitation, mm
     *
     * @var float
     */
    public $value;

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

}