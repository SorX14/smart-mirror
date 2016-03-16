<?php
/**
 * User: steve
 * Date: 16/03/16
 * Time: 08:20
 */

namespace Weather\Models;


class GpsCoordinates
{

    /**
     * @var double
     */
    public $longitude;

    /**
     * @var double
     */
    public $latitude;

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }


}