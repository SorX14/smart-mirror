<?php
/**
 * User: steve
 * Date: 15/03/16
 * Time: 08:59
 */

namespace Weather\Models;


class WeatherItem
{

    /**
     * Last time when data was updated
     *
     * @var \DateTime
     */
    public $timestamp;

    /**
     * Details of the temperature, and range
     *
     * @var Temperature
     */
    public $temperature;

    /**
     * @var Humidity
     */
    public $humidity;

    /**
     * @var Pressure
     */
    public $pressure;

    /**
     * @var Wind
     */
    public $wind;

    /**
     * @var Clouds
     */
    public $clouds;

    /**
     * @var string
     */
    public $visibility;

    /**
     * @var Precipitation
     */
    public $precipitation;

    /**
     * Weather condition ID
     *
     * @var integer
     */
    public $number;

    /**
     * Weather condition name
     *
     * @var string
     */
    public $value;

    /**
     * Weather icon ID
     *
     * @var string
     */
    public $icon;

    /**
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param \DateTime $timestamp
     */
    public function setTimestamp(\DateTime $timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return Temperature
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @param Temperature $temperature
     */
    public function setTemperature(Temperature $temperature)
    {
        $this->temperature = $temperature;
    }

    /**
     * @return Humidity
     */
    public function getHumidity()
    {
        return $this->humidity;
    }

    /**
     * @param Humidity $humidity
     */
    public function setHumidity(Humidity $humidity)
    {
        $this->humidity = $humidity;
    }

    /**
     * @return Pressure
     */
    public function getPressure()
    {
        return $this->pressure;
    }

    /**
     * @param Pressure $pressure
     */
    public function setPressure(Pressure $pressure)
    {
        $this->pressure = $pressure;
    }

    /**
     * @return Wind
     */
    public function getWind()
    {
        return $this->wind;
    }

    /**
     * @param Wind $wind
     */
    public function setWind(Wind $wind)
    {
        $this->wind = $wind;
    }

    /**
     * @return Clouds
     */
    public function getClouds()
    {
        return $this->clouds;
    }

    /**
     * @param Clouds $clouds
     */
    public function setClouds(Clouds $clouds)
    {
        $this->clouds = $clouds;
    }

    /**
     * @return string
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * @param string $visibility
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
    }

    /**
     * @return Precipitation
     */
    public function getPrecipitation()
    {
        return $this->precipitation;
    }

    /**
     * @param Precipitation $precipitation
     */
    public function setPrecipitation(Precipitation $precipitation)
    {
        $this->precipitation = $precipitation;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }


}