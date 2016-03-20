<?php
/**
 * User: stephen.parker
 * Date: 20/03/2016
 * Time: 01:01
 */

namespace Weather\Hydrators\OpenWeatherMap\Factories;


use Weather\Hydrators\OpenWeatherMap\WeatherHydrator;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WeatherHydratorFactory implements FactoryInterface
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
        $weatherItemHydrator = $serviceLocator->get('Weather/Hydrators/OpenWeatherMap/WeatherItemHydrator');
        $cityHydrator = $serviceLocator->get('Weather/Hydrators/OpenWeatherMap/CityHydrator');

        $service = new WeatherHydrator(
            $weatherItemHydrator,
            $cityHydrator
        );

        return $service;
    }
}