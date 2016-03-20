<?php
/**
 * User: stephen.parker
 * Date: 20/03/2016
 * Time: 01:14
 */

namespace Weather\Hydrators\OpenWeatherMap\Factories;


use Weather\Hydrators\OpenWeatherMap\CityHydrator;
use Weather\Hydrators\OpenWeatherMap\GpsCoordinatesHydrator;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CityHydratorFactory implements FactoryInterface
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
         * @var GpsCoordinatesHydrator $gpsCoordinatesHydrator
         */
        $gpsCoordinatesHydrator = $serviceLocator->get('Weather/Hydrators/OpenWeatherMap/GpsCoordinatesHydrator');

        $service = new CityHydrator($gpsCoordinatesHydrator);

        return $service;
    }
}