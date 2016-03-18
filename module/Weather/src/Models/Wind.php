<?php
/**
 * User: steve
 * Date: 16/03/16
 * Time: 08:31
 */

namespace Weather\Models;


class Wind
{

    /**
     * Wind speed in metres per second
     *
     * @var float
     */
    public $speedValue;

    /**
     * Wind direction in degrees (meteorological)
     *
     * @var float
     */
    public $directionValue;

    /**
     * @return float
     */
    public function getSpeedValue()
    {
        return $this->speedValue;
    }

    /**
     * @param float $speedValue
     */
    public function setSpeedValue($speedValue)
    {
        $this->speedValue = $speedValue;
    }

    /**
     * @return float
     */
    public function getDirectionValue()
    {
        return $this->directionValue;
    }

    /**
     * @param float $directionValue
     */
    public function setDirectionValue($directionValue)
    {
        $this->directionValue = $directionValue;
    }
}