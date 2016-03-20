<?php
/**
 * User: steve
 * Date: 15/03/16
 * Time: 08:57
 */

namespace Weather\Service;

use Weather\Hydrators\OpenWeatherMap\ForecastHydrator;
use Weather\Hydrators\OpenWeatherMap\WeatherHydrator;
use Weather\Interfaces\ForecastProviderInterface;
use Weather\Interfaces\WeatherProviderInterface;
use Weather\Models\Forecast;
use Weather\Models\Weather;
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

    /**
     * @var \Weather\Hydrators\OpenWeatherMap\ForecastHydrator
     */
    protected $forecastHydrator;

    public function __construct(
        Client $weatherClient,
        Client $forecastClient,
        StorageInterface $storageInterface,
        WeatherHydrator $weatherHydrator,
        ForecastHydrator $forecastHydrator
    )
    {
        $this->weatherClient = $weatherClient;
        $this->forecastClient = $forecastClient;
        $this->storageInterface = $storageInterface;
        $this->weatherHydrator = $weatherHydrator;
        $this->forecastHydrator = $forecastHydrator;
    }

    /**
     * @return \Weather\Models\Weather
     * @throws \Exception
     */
    public function getWeather()
    {
        $this->storageInterface->removeItem('weather');
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
            $json = json_decode($result->getBody(), true);

            $weather = new Weather();

            $this->weatherHydrator->hydrate($json, $weather);
            $this->storageInterface->setItem('weather', $weather);
            return $weather;
        } else {
            throw new \Exception ('Failed to update weather information');
        }
    }

    public function getForecast()
    {
        $this->storageInterface->removeItem('forecast');
        if (!$this->storageInterface->hasItem('forecast')) {
            $this->updateForecast();
        }

        return $this->storageInterface->getItem('forecast');
    }

    public function updateForecast()
    {
        $result = $this->forecastClient->send();

        if ($result->getStatusCode() == 200) {
            $json = json_decode($result->getBody(), true);

            $forecast = new Forecast();

            $this->forecastHydrator->hydrate($json, $forecast);
            $this->storageInterface->setItem('forecast', $forecast);

            return $forecast;
        } else {
            throw new \Exception ('Failed to update forecast information');
        }
    }
}