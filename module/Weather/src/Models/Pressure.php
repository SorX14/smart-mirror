<?php
/**
 * User: steve
 * Date: 16/03/16
 * Time: 08:28
 */

namespace Weather\Models;


class Pressure
{

    /**
     * Value
     *
     * @var float
     */
    public $value;

    /**
     * Units
     *
     * @var string
     */
    public $units;

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

    /**
     * @return string
     */
    public function getUnits()
    {
        return $this->units;
    }

    /**
     * @param string $units
     */
    public function setUnits($units)
    {
        $this->units = $units;
    }


}