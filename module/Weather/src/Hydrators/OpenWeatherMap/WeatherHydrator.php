<?php
/**
 * User: Steve
 * Date: 18/03/2016
 * Time: 21:08
 */

namespace Weather\Hydrators\OpenWeatherMap;


use Weather\Models\City;
use Weather\Models\Clouds;
use Weather\Models\GpsCoordinates;
use Weather\Models\Humidity;
use Weather\Models\Precipitation;
use Weather\Models\Pressure;
use Weather\Models\Temperature;
use Weather\Models\Weather;
use Weather\Models\Wind;

class WeatherHydrator
{

    /**
     * {"id":300,"main":"Drizzle","description":"light intensity
     * drizzle","icon":"09n"},{"id":721,"main":"Haze","description":"haze","icon":"50n"}],"base":"stations","main":{"temp":5.47,"pressure":1026,"humidity":87,"temp_min":5,"temp_max":6},"visibility":10000,"wind":{"speed":5.1,"deg":50},"clouds":{"all":90},"dt":1458334200,"sys":{"type":1,"id":5162,"message":0.0324,"country":"GB","sunrise":1458281603,"sunset":1458325249},"id":2648404,"name":"Gloucester","cod":200}
     */

    public function hydrate(\stdClass $input)
    {
        print_r($input);

        $city = $this->hydrateCity($input);
        $temperature = $this->hydrateTemperature($input);
        $humidity = $this->hydrateHumidity($input);
        $pressure = $this->hydratePressure($input);
        $wind = $this->hydrateWind($input);
        $clouds = $this->hydrateClouds($input);
        $precipitation = $this->hydratePrecipitation($input);

        $weather = new Weather();
        $weather->setTimestamp(new \DateTime('@' . $input->dt));
        $weather->setCity($city);
        $weather->setTemperature($temperature);
        $weather->setHumidity($humidity);
        $weather->setPressure($pressure);
        $weather->setWind($wind);
        $weather->setClouds($clouds);
        if (isset($input->visibility)) {
            $weather->setVisibility($input->visibility);
        }
        $weather->setPrecipitation($precipitation);
        $weather->setNumber($input->weather[0]->id);
        $weather->setValue($input->weather[0]->main);
        $weather->setIcon($input->weather[0]->icon);

        print_r($weather);

        return $weather;
    }

    /**
     * @param \stdClass $input
     *
     * @return \Weather\Models\City
     */
    private function hydrateCity(\stdClass $input)
    {
        $city = new City();
        $city->setName($input->name);
        $city->setLocation($this->hydrateGps($input->coord->lat, $input->coord->lon));
        $city->setSunrise(new \DateTime('@' . $input->sys->sunrise));
        $city->setSunset(new \DateTime('@' . $input->sys->sunset));

        return $city;
    }

    /**
     * @param $latitude
     * @param $longitude
     *
     * @return \Weather\Models\GpsCoordinates
     */
    private function hydrateGps($latitude, $longitude)
    {
        $gps = new GpsCoordinates();
        $gps->setLatitude($latitude);
        $gps->setLongitude($longitude);

        return $gps;
    }

    /**
     * @param \stdClass $input
     *
     * @return \Weather\Models\Temperature
     */
    private function hydrateTemperature(\stdClass $input)
    {
        $temperature = new Temperature();
        $temperature->setValue($input->main->temp);
        $temperature->setMin($input->main->temp_min);
        $temperature->setMax($input->main->temp_max);
        $temperature->setUnits('C');

        return $temperature;
    }

    /**
     * @param \stdClass $input
     *
     * @return \Weather\Models\Humidity
     */
    private function hydrateHumidity(\stdClass $input)
    {
        $humidity = new Humidity();
        $humidity->setValue($input->main->humidity);
        $humidity->setUnits('%RH');

        return $humidity;
    }

    /**
     * @param \stdClass $input
     *
     * @return \Weather\Models\Pressure
     */
    private function hydratePressure(\stdClass $input)
    {
        $pressure = new Pressure();
        $pressure->setValue($input->main->pressure);
        $pressure->setUnits('hPa');

        return $pressure;
    }

    /**
     * @param \stdClass $input
     *
     * @return \Weather\Models\Wind
     */
    private function hydrateWind(\stdClass $input)
    {
        $wind = new Wind();
        $wind->setSpeedValue($input->wind->speed);
        $wind->setDirectionValue($input->wind->deg);

        return $wind;
    }

    /**
     * @param \stdClass $input
     *
     * @return \Weather\Models\Clouds
     */
    private function hydrateClouds(\stdClass $input)
    {
        $clouds = new Clouds();
        $clouds->setValue($input->clouds->all);

        return $clouds;
    }

    /**
     * @param \stdClass $input
     *
     * @return \Weather\Models\Precipitation
     */
    private function hydratePrecipitation(\stdClass $input)
    {
        $precipitation = new Precipitation();
        $precipitation->setValue($input->rain->{'3h'});

        return $precipitation;
    }

}