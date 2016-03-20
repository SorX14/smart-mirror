<?php
/**
 * User: stephen.parker
 * Date: 20/03/2016
 * Time: 01:21
 */

namespace Weather\Hydrators\OpenWeatherMap\Factories;


use Weather\Hydrators\OpenWeatherMap\CityHydrator;
use Weather\Hydrators\OpenWeatherMap\ForecastHydrator;
use Weather\Hydrators\OpenWeatherMap\WeatherItemHydrator;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ForecastHydratorFactory implements FactoryInterface
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
        /**
         * @var CityHydrator $cityHydrator
         */
        $cityHydrator = $serviceLocator->get('Weather/Hydrators/OpenWeatherMap/CityHydrator');

        /**
         * @var WeatherItemHydrator $weatherItemHydrator
         */
        $weatherItemHydrator = $serviceLocator->get('Weather/Hydrators/OpenWeatherMap/WeatherItemHydrator');

        $service = new ForecastHydrator(
            $cityHydrator,
            $weatherItemHydrator
        );

        return $service;
    }
}