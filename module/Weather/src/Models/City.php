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
     * @var \DateTime
     */
    public $sunrise;

    /**
     * Time of sunset
     *
     * @var \DateTime
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
     * @return \DateTime
     */
    public function getSunrise()
    {
        return $this->sunrise;
    }

    /**
     * @param \DateTime $sunrise
     */
    public function setSunrise(\DateTime $sunrise)
    {
        $this->sunrise = $sunrise;
    }

    /**
     * @return \DateTime
     */
    public function getSunset()
    {
        return $this->sunset;
    }

    /**
     * @param \DateTime $sunset
     */
    public function setSunset(\DateTime $sunset)
    {
        $this->sunset = $sunset;
    }

}