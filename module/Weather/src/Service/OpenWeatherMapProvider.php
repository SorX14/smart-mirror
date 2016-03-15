<?php
/**
 * User: steve
 * Date: 15/03/16
 * Time: 08:57
 */

namespace Weather\Service;


use Weather\Interfaces\ForecastProviderInterface;
use Weather\Interfaces\WeatherProviderInterface;
use Zend\Cache\Storage\StorageInterface;
use Zend\Http\Client;

class OpenWeatherMapProvider implements WeatherProviderInterface, ForecastProviderInterface
{

    /**
     * @var \Zend\Http\Client
     */
    protected $weatherClient;

    /**
     * @var \Zend\Http\Client
     */
    protected $forecastClient;

    /**
     * @var \Zend\Cache\Storage\StorageInterface
     */
    protected $storageInterface;

    protected $weather;
    protected $forecast;

    public function __construct(Client $weatherClient, Client $forecastClient, StorageInterface $storageInterface)
    {
        $this->weatherClient = $weatherClient;
        $this->forecastClient = $forecastClient;
        $this->storageInterface = $storageInterface;
    }

    public function getWeather()
    {

    }

    public function updateWeather()
    {
        $result = $this->weatherClient->send();

        return $result;
    }

    public function getForecast()
    {
        // TODO: Implement getForecast() method.
    }

    public function updateForecast()
    {
        $result = $this->forecastClient->send();

        return $result;
    }
}