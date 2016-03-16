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
     * Name of the wind
     *
     * @var string
     */
    public $speedName;

    /**
     * Wind direction in degrees (meteorological)
     *
     * @var float
     */
    public $directionValue;

    /**
     * Cardinal direction
     *
     * @var string
     */
    public $directionCode;

    /**
     * Full name of the wind direction
     *
     * @var string
     */
    public $directionName;

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
     * @return string
     */
    public function getSpeedName()
    {
        return $this->speedName;
    }

    /**
     * @param string $speedName
     */
    public function setSpeedName($speedName)
    {
        $this->speedName = $speedName;
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

    /**
     * @return string
     */
    public function getDirectionCode()
    {
        return $this->directionCode;
    }

    /**
     * @param string $directionCode
     */
    public function setDirectionCode($directionCode)
    {
        $this->directionCode = $directionCode;
    }

    /**
     * @return string
     */
    public function getDirectionName()
    {
        return $this->directionName;
    }

    /**
     * @param string $directionName
     */
    public function setDirectionName($directionName)
    {
        $this->directionName = $directionName;
    }

    /**
     * Exchange internal values from provided array
     *
     * @param  array $array
     *
     * @return void
     *
     * public function exchangeArray(array $array)
     * {
     * if (isset($array['speed'])) {
     * $this->setSpeedValue($array['speed']);
     * }
     * if (isset($array['deg'])) {
     * $this->setDirectionValue($array['deg']);
     * }
     * }
     *
     * /**
     * Return an array representation of the object
     *
     * @return array
     *
     * public function getArrayCopy()
     * {
     * return get_object_vars($this);
     * }
     */
}