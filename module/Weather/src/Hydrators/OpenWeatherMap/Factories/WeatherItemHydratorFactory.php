<?php
/**
 * User: stephen.parker
 * Date: 19/03/2016
 * Time: 23:45
 */

namespace Weather\Hydrators\OpenWeatherMap\Factories;

use Weather\Hydrators\OpenWeatherMap\WeatherItemHydrator;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WeatherItemHydratorFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new WeatherItemHydrator();

        return $hydrator;
    }

}