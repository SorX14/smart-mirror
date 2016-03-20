<?php
/**
 * User: stephen.parker
 * Date: 20/03/2016
 * Time: 00:33
 */

namespace Weather\Hydrators\OpenWeatherMap;

use Weather\Models\Clouds;
use Weather\Models\Humidity;
use Weather\Models\Precipitation;
use Weather\Models\Pressure;
use Weather\Models\Temperature;
use Weather\Models\WeatherItem;
use Weather\Models\Wind;

class WeatherItemHydrator
{

    public function hydrate(array $input, WeatherItem $object)
    {
        $object->setTimestamp(new \DateTime('@' . $input['dt']));
        $object->setNumber($input['weather'][0]['id']);
        $object->setValue($input['weather'][0]['main']);
        $object->setIcon($input['weather'][0]['icon']);
        if (isset($input['visibility'])) {
            $object->setVisibility($input['visibility']);
        }

        $temperature = new Temperature();
        $temperature->setValue($input['main']['temp']);
        $temperature->setMin($input['main']['temp_min']);
        $temperature->setMax($input['main']['temp_max']);
        $temperature->setUnits('C');
        $object->setTemperature($temperature);

        $humidity = new Humidity();
        $humidity->setValue($input['main']['humidity']);
        $humidity->setUnits('%RH');
        $object->setHumidity($humidity);

        $pressure = new Pressure();
        $pressure->setValue($input['main']['pressure']);
        $pressure->setUnits('hPa');
        $object->setPressure($pressure);

        $wind = new Wind();
        $wind->setSpeedValue($input['wind']['speed']);
        $wind->setDirectionValue($input['wind']['deg']);
        $object->setWind($wind);

        $clouds = new Clouds();
        $clouds->setValue($input['clouds']['all']);
        $object->setClouds($clouds);

        $precipitation = new Precipitation();
        if (isset($input['rain']['3h'])) {
            $precipitation->setValue($input['rain']['3h']);
        }
        $object->setPrecipitation($precipitation);

        return $object;
    }

}