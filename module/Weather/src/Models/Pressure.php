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
     * Unit
     *
     * @var string
     */
    public $unit;

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
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }


}