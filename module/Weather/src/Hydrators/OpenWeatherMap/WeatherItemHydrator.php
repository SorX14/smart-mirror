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
        $mainRaw = (isset($input['main']) ? $input['main'] : $input);
        $temperature->setUnits('C');

        // Daily forecast is a different format
        if (isset($input['main'])) {
            $mainRaw = $input['main'];
            $temperature->setValue($mainRaw['temp']);
            $temperature->setMin($mainRaw['temp_min']);
            $temperature->setMax($mainRaw['temp_max']);
        } else {
            $temperature->setValue($mainRaw['temp']['day']);
            $temperature->setMin($mainRaw['temp']['morn']);
            $temperature->setMax($mainRaw['temp']['eve']);
        }
        $object->setTemperature($temperature);

        $humidity = new Humidity();
        $humidity->setValue($mainRaw['humidity']);
        $humidity->setUnits('%RH');
        $object->setHumidity($humidity);

        $pressure = new Pressure();
        $pressure->setValue($mainRaw['pressure']);
        $pressure->setUnits('hPa');
        $object->setPressure($pressure);

        $wind = new Wind();
        if (isset($input['wind'])) {
            $wind->setSpeedValue($input['wind']['speed']);
            $wind->setDirectionValue($input['wind']['deg']);
        } else {
            $wind->setSpeedValue($input['speed']);
            $wind->setDirectionValue($input['deg']);
        }
        $object->setWind($wind);

        $clouds = new Clouds();
        if (isset($input['clouds']['all'])) {
            $clouds->setValue($input['clouds']['all']);
        } else {
            $clouds->setValue($input['clouds']);
        }
        $object->setClouds($clouds);

        $precipitation = new Precipitation();
        if (isset($input['rain']['3h'])) {
            $precipitation->setValue($input['rain']['3h']);
        }
        $object->setPrecipitation($precipitation);

        return $object;
    }

}