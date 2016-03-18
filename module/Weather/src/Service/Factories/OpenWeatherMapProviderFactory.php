<?php
/**
 * User: steve
 * Date: 15/03/16
 * Time: 09:02
 */

namespace Weather\Service\Factories;


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
        ]);

        /**
         * @var StorageInterface $storageAdapter
         */
        $storageAdapter = $serviceLocator->get('Redis\Cache\Redis');
        //$storageAdapter = new BlackHole();
        
        $hydrator = new WeatherHydrator();

        $service = new OpenWeatherMapProvider(
            $weatherClient,
            $forecastClient,
            $storageAdapter,
            $hydrator
        );

        return $service;
    }

}