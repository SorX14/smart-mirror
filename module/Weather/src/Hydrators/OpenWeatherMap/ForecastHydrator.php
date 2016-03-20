<?php
/**
 * User: stephen.parker
 * Date: 20/03/2016
 * Time: 01:21
 */

namespace Weather\Hydrators\OpenWeatherMap;


use Weather\Models\City;
use Weather\Models\Forecast;
use Weather\Models\WeatherItem;

class ForecastHydrator
{
    /**
     * @var \Weather\Hydrators\OpenWeatherMap\CityHydrator
     */
    protected $cityHydrator;

    /**
     * @var \Weather\Hydrators\OpenWeatherMap\WeatherItemHydrator
     */
    protected $weatherItemHydrator;

    public function __construct(
        CityHydrator $cityHydrator,
        WeatherItemHydrator $weatherItemHydrator
    ) {
        $this->cityHydrator = $cityHydrator;
        $this->weatherItemHydrator = $weatherItemHydrator;
    }

    public function hydrate(array $input, Forecast $object)
    {
        $city = new City();
        $this->cityHydrator->hydrate($input['city'], $city);
        $object->setCity($city);

        foreach ($input['list'] as $v) {
            echo '<pre>';
            print_r($v);
            echo '</pre>';
            $weatherItem = new WeatherItem();
            $this->weatherItemHydrator->hydrate($v, $weatherItem);
            $object->addWeatherItem($weatherItem);
        }

        return $object;
    }
}