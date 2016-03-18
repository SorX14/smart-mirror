<?php
/**
 * User: steve
 * Date: 15/03/16
 * Time: 08:57
 */

namespace Weather\Service;


use Weather\Hydrators\OpenWeatherMap\WeatherHydrator;
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

    /**
     * @var \Weather\Hydrators\OpenWeatherMap\WeatherHydrator
     */
    protected $weatherHydrator;

    protected $weather;
    protected $forecast;

    public function __construct(
        Client $weatherClient,
        Client $forecastClient,
        StorageInterface $storageInterface,
        WeatherHydrator $weatherHydrator
    )
    {
        $this->weatherClient = $weatherClient;
        $this->forecastClient = $forecastClient;
        $this->storageInterface = $storageInterface;
        $this->weatherHydrator = $weatherHydrator;
    }

    /**
     * @return \Weather\Models\Weather
     * @throws \Exception
     */
    public function getWeather()
    {
        if (!$this->storageInterface->hasItem('weather')) {
            $this->updateWeather();
        }

        return $this->storageInterface->getItem('weather');
    }

    /**
     * @return \Weather\Models\Weather
     * @throws \Exception
     */
    public function updateWeather()
    {
        $result = $this->weatherClient->send();

        if ($result->getStatusCode() == 200) {
            $weather = $this->weatherHydrator->hydrate(json_decode($result->getBody()));
            $this->storageInterface->setItem('weather', $weather);

            return $weather;
        } else {
            throw new \Exception ('Failed to update weather information');
        }
    }

    public function getForecast()
    {
        $forecast = $this->updateForecast();

        print_r($forecast);
    }

    public function updateForecast()
    {
        $result = $this->forecastClient->send();

        if ($result->getStatusCode() == 200) {
            return json_decode($result->getBody(), true);
        } else {
            throw new \Exception ('Failed to update forecast information');
        }
    }
}