<?php
/**
 * User: steve
 * Date: 16/03/16
 * Time: 09:31
 */

namespace Weather\Hydrators\OpenWeatherMap;


use Weather\Models\City;
use Zend\Hydrator\HydratorInterface;
use Zend\Hydrator\Strategy;
use Zend\Hydrator\StrategyEnabledInterface;

class CityHydrator implements HydratorInterface, StrategyEnabledInterface
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
        if (!$object instanceof City) {
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
        if (!$object instanceof City) {
            return $object;
        }

        if (isset($data['name'])) {
            $object->setName($data['name']);
        }

        if (isset($data['sunrise'])) {
            $time = new \DateTime();
            $time->setTimestamp((int)$data['sunrise']);
            $object->setSunrise($time);
        }

        if (isset($data['sunset'])) {
            $time = new \DateTime();
            $time->setTimestamp((int)$data['sunset']);
            $object->setSunset($time);
        }

        return $object;
    }

    /**
     * Adds the given strategy under the given name.
     *
     * @param string                     $name     The name of the strategy to register.
     * @param Strategy\StrategyInterface $strategy The strategy to register.
     *
     * @return self
     */
    public function addStrategy($name, Strategy\StrategyInterface $strategy)
    {
        // TODO: Implement addStrategy() method.
    }

    /**
     * Gets the strategy with the given name.
     *
     * @param string $name The name of the strategy to get.
     *
     * @return Strategy\StrategyInterface
     */
    public function getStrategy($name)
    {
        // TODO: Implement getStrategy() method.
    }

    /**
     * Checks if the strategy with the given name exists.
     *
     * @param string $name The name of the strategy to check for.
     *
     * @return bool
     */
    public function hasStrategy($name)
    {
        // TODO: Implement hasStrategy() method.
    }

    /**
     * Removes the strategy with the given name.
     *
     * @param string $name The name of the strategy to remove.
     *
     * @return self
     */
    public function removeStrategy($name)
    {
        // TODO: Implement removeStrategy() method.
    }
}