<?php
/**
 * User: steve
 * Date: 15/03/16
 * Time: 09:02
 */

namespace Weather\Service\Factories;


use Weather\Hydrators\OpenWeatherMap\ForecastHydrator;
use Weather\Hydrators\OpenWeatherMap\WeatherHydrator;
use Weather\Service\OpenWeatherMapProvider;
use Zend\Cache\Storage\StorageInterface;
use Zend\Http\Client;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class OpenWeatherMapProviderFactory implements FactoryInterface
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
        $config = $serviceLocator->get('Config');
        $openWeatherMapConfig = $config['weather']['openWeatherMap'];

        $weatherClient = new Client(
            $openWeatherMapConfig['weatherUrl'],
            $openWeatherMapConfig['clientOptions']
        );
        $weatherClient->setParameterGet([
            'appid' => $openWeatherMapConfig['apiKey'],
            'id'    => $openWeatherMapConfig['cityId'],
            'units' => $openWeatherMapConfig['units'],
        ]);

        $forecastClient = new Client(
            $openWeatherMapConfig['forecastUrl'],
            $openWeatherMapConfig['clientOptions']
        );

        $forecastClient->setParameterGet([
            'appid' => $openWeatherMapConfig['apiKey'],
            'id'    => $openWeatherMapConfig['cityId'],
            'units' => $openWeatherMapConfig['units'],
            'cnt'   => 8, // Get 8 days of forecast because it also includes today sometimes
        ]);

        /**
         * @var StorageInterface $storageAdapter
         */
        $storageAdapter = $serviceLocator->get('Redis\Cache\Redis');
        //$storageAdapter = new BlackHole();

        /**
         * @var WeatherHydrator $weatherHydrator
         */
        $weatherHydrator = $serviceLocator->get('Weather/Hydrators/OpenWeatherMap/WeatherHydrator');

        /**
         * @var ForecastHydrator $forecastHydrator
         */
        $forecastHydrator = $serviceLocator->get('Weather/Hydrators/OpenWeatherMap/ForecastHydrator');

        $service = new OpenWeatherMapProvider(
            $weatherClient,
            $forecastClient,
            $storageAdapter,
            $weatherHydrator,
            $forecastHydrator,
            true // Debug mode
        );

        return $service;
    }

}