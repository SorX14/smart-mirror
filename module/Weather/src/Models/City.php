<?php
/**
 * User: steve
 * Date: 16/03/16
 * Time: 08:19
 */

namespace Weather\Models;


class City
{

    /**
     * Name of the city
     *
     * @var string
     */
    public $name;

    /**
     * Where the city is (where the reading was taken)
     *
     * @var GpsCoordinates
     */
    public $location;

    /**
     * Time of sunrise
     *
     * @var int
     */
    public $sunrise;

    /**
     * Time of sunset
     *
     * @var int
     */
    public $sunset;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return GpsCoordinates
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param GpsCoordinates $location
     */
    public function setLocation(GpsCoordinates $location)
    {
        $this->location = $location;
    }

    /**
     * @return int
     */
    public function getSunrise()
    {
        return $this->sunrise;
    }

    /**
     * @param int $sunrise
     */
    public function setSunrise($sunrise)
    {
        $this->sunrise = $sunrise;
    }

    /**
     * @return int
     */
    public function getSunset()
    {
        return $this->sunset;
    }

    /**
     * @param int $sunset
     */
    public function setSunset($sunset)
    {
        $this->sunset = $sunset;
    }

}