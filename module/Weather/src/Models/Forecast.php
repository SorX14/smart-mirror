<?php
/**
 * User: steve
 * Date: 15/03/16
 * Time: 09:00
 */

namespace Weather\Models;


class Forecast
{

    /**
     * @var City
     */
    public $city;

    /**
     * @var WeatherItem[]
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
     * @return WeatherItem[]
     */
    public function getWeatherItem()
    {
        return $this->weatherItem;
    }

    /**
     * @param WeatherItem[] $weatherItem
     */
    public function setWeatherItem($weatherItem)
    {
        $this->weatherItem = $weatherItem;
    }

    public function addWeatherItem(WeatherItem $weatherItem)
    {
        $this->weatherItem[] = $weatherItem;
    }

}