<?php
/**
 * User: stephen.parker
 * Date: 20/03/2016
 * Time: 00:57
 */

namespace Weather\Hydrators\OpenWeatherMap;


use Weather\Models\City;
use Weather\Models\Weather;
use Weather\Models\WeatherItem;

class WeatherHydrator
{

    /**
     * @var \Weather\Hydrators\OpenWeatherMap\WeatherItemHydrator
     */
    protected $weatherItemHydrator;

    /**
     * @var \Weather\Hydrators\OpenWeatherMap\CityHydrator
     */
    protected $cityHydrator;

    public function __construct(
        WeatherItemHydrator $weatherItemHydrator,
        CityHydrator $cityHydrator
    ) {
        $this->weatherItemHydrator = $weatherItemHydrator;
        $this->cityHydrator = $cityHydrator;
    }

    public function hydrate(array $input, Weather $object)
    {
        $city = new City();
        $this->cityHydrator->hydrate($input, $city);
        $object->setCity($city);

        $weatherItem = new WeatherItem();
        $this->weatherItemHydrator->hydrate($input, $weatherItem);

        $object->setWeatherItem($weatherItem);

        return $object;
    }
}