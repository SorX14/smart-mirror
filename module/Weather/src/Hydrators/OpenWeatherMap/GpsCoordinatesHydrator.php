<?php
/**
 * User: stephen.parker
 * Date: 20/03/2016
 * Time: 01:12
 */

namespace Weather\Hydrators\OpenWeatherMap;


use Weather\Models\GpsCoordinates;

class GpsCoordinatesHydrator
{
    public function hydrate(array $input, GpsCoordinates $object)
    {
        $object->setLatitude($input['coord']['lat']);
        $object->setLongitude($input['coord']['lon']);

        return $object;
    }
}