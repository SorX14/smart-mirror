<?php
/**
 * User: steve
 * Date: 16/03/16
 * Time: 08:39
 */

namespace Weather\Hydrators\OpenWeatherMap;


use Weather\Models\Wind;
use Zend\Hydrator\HydratorInterface;

class WindHydrator implements HydratorInterface
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
        if (!$object instanceof Wind) {
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
        if (!$object instanceof Wind) {
            return $object;
        }

        if (isset($data['speed'])) {
            $object->setSpeedValue($data['speed']);
        }
        if (isset($data['deg'])) {
            $object->setDirectionValue($data['deg']);
        }

        return $object;
    }
}