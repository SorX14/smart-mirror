<?php
/**
 * User: steve
 * Date: 16/03/16
 * Time: 08:26
 */

namespace Weather\Models;


class Temperature
{

    /**
     * Temperature
     *
     * @var float
     */
    public $value;

    /**
     * Minimum temperature at the moment of calculation
     *
     * @var float
     */
    public $min;

    /**
     * Maximum temperature at the moment of calculation
     *
     * @var float
     */
    public $max;

    /**
     * Units for the above values
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
     * @return float
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @param float $min
     */
    public function setMin($min)
    {
        $this->min = $min;
    }

    /**
     * @return float
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @param float $max
     */
    public function setMax($max)
    {
        $this->max = $max;
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