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

    /**
     * @var boolean
     */
    protected $debug = false;

    public function __construct(
        Client $weatherClient,
        Client $forecastClient,
        StorageInterface $storageInterface,
        WeatherHydrator $weatherHydrator,
        ForecastHydrator $forecastHydrator,
        $debug = false
    )
    {
        $this->weatherClient = $weatherClient;
        $this->forecastClient = $forecastClient;
        $this->storageInterface = $storageInterface;
        $this->weatherHydrator = $weatherHydrator;
        $this->forecastHydrator = $forecastHydrator;

        $this->debug = $debug;
    }

    /**
     * Get the currently cached observation
     *
     * @return \Weather\Models\Weather
     * @throws \Exception
     */
    public function getWeather()
    {
        if ($this->debug) {
            $this->storageInterface->removeItem('weather');
        }
        if (!$this->storageInterface->hasItem('weather')) {
            $this->updateWeather();
        }

        return $this->storageInterface->getItem('weather');
    }

    /**
     * Request the latest observation
     *
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

    /**
     * Get the currently cached forecast
     *
     * @return mixed
     * @throws \Exception
     */
    public function getForecast()
    {
        if ($this->debug) {
            $this->storageInterface->removeItem('forecast');
        }
        if (!$this->storageInterface->hasItem('forecast')) {
            $this->updateForecast();
        }

        return $this->storageInterface->getItem('forecast');
    }

    /**
     * Requests the latest forecast
     *
     * @return \Weather\Models\Forecast
     * @throws \Exception
     */
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