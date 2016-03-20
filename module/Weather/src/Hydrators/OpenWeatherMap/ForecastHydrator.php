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

        $days = 0;
        foreach ($input['list'] as $v) {
            // Ignore days that match today
            $forecastDate = new \DateTime('@' . $v['dt']);
            $currentDate = new \DateTime();
            $currentDate->setTime(12, 00, 00);
            $difference = $currentDate->getTimestamp() - $forecastDate->getTimestamp();

            if ($difference > 0) {
                continue;
            }

            $days++;
            if ($days > 7) {
                break;
            }

            $weatherItem = new WeatherItem();
            $this->weatherItemHydrator->hydrate($v, $weatherItem);
            $object->addWeatherItem($weatherItem);
        }

        return $object;
    }
}