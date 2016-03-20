<?php
/**
 * User: steve
 * Date: 15/03/16
 * Time: 08:59
 */

namespace Weather\Models;


class Weather
{

    /**
     * Details on the city this Weather object is for
     *
     * @var City
     */
    public $city;

    /**
     * The actual weather item
     *
     * @var WeatherItem
     */
    public $weatherItem;

    /**
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param City $city
     */
    public function setCity(City $city)
    {
        $this->city = $city;
    }

    /**
     * @return WeatherItem
     */
    public function getWeatherItem()
    {
        return $this->weatherItem;
    }

    /**
     * @param WeatherItem $weatherItem
     */
    public function setWeatherItem(WeatherItem $weatherItem)
    {
        $this->weatherItem = $weatherItem;
    }
}