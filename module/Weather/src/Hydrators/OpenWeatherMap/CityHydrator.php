<?php
/**
 * User: stephen.parker
 * Date: 20/03/2016
 * Time: 01:05
 */

namespace Weather\Hydrators\OpenWeatherMap;


use Weather\Models\City;
use Weather\Models\GpsCoordinates;

class CityHydrator
{

    /**
     * @var \Weather\Hydrators\OpenWeatherMap\GpsCoordinatesHydrator
     */
    protected $gpsCoordinatesHydrator;

    public function __construct(GpsCoordinatesHydrator $gpsCoordinatesHydrator)
    {
        $this->gpsCoordinatesHydrator = $gpsCoordinatesHydrator;
    }

    public function hydrate(array $input, City $object)
    {
        $gpsCoordinates = new GpsCoordinates();
        $this->gpsCoordinatesHydrator->hydrate($input, $gpsCoordinates);

        $object->setLocation($gpsCoordinates);
        $object->setName($input['name']);
        if (isset($input['sys']['sunrise'])) {
            $object->setSunrise(new \DateTime('@' . $input['sys']['sunrise']));
        }
        if (isset($input['sys']['sunset'])) {
            $object->setSunset(new \DateTime('@' . $input['sys']['sunset']));
        }

        return $object;
    }
}