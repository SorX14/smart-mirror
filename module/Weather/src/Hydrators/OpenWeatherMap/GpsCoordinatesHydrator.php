<?php
/**
 * User: steve
 * Date: 16/03/16
 * Time: 09:30
 */

namespace Weather\Hydrators\OpenWeatherMap;


use Weather\Models\GpsCoordinates;
use Zend\Hydrator\HydratorInterface;

class GpsCoordinatesHydrator implements HydratorInterface
{

    /**
     * Extract values from an object
     *
     * @param  object $object
     *
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof GpsCoordinates) {
            return [];
        }

        return get_object_vars($object);
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array  $data
     * @param  object $object
     *
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof GpsCoordinates) {
            return $object;
        }

        if (isset($data['lat'])) {
            $object->setLatitude($data['lat']);
        }
        if (isset($data['lon'])) {
            $object->setLongitude($data['lon']);
        }

        return $object;
    }
}