<?php
/**
 * User: steve
 * Date: 15/03/16
 * Time: 08:57
 */

namespace Weather\Service;


use Weather\Hydrators\OpenWeatherMap\WindHydrator;
use Weather\Interfaces\ForecastProviderInterface;
use Weather\Interfaces\WeatherProviderInterface;
use Weather\Models\Wind;
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
        if ($this->weather == '') {
            $this->weather = $this->updateWeather();
        }

        // http://framework.zend.com/manual/current/en/modules/zend.stdlib.hydrator.aggregate.html
        // Use bespoke hydrators to decouple the link between provider and the underlying object tree

        $wind = new Wind();
        $hydrator = new WindHydrator();
        $hydrator->hydrate($this->weather['wind'], $wind);

        error_log(print_r($wind, true));

        return $this->weather;
    }

    public function updateWeather()
    {
        $result = $this->weatherClient->send();

        if ($result->getStatusCode() == 200) {
            return json_decode($result->getBody(), true);
        } else {
            throw new \Exception ('Failed to update weather information');
        }
    }

    public function getForecast()
    {
        if ($this->forecast == '') {
            //$this->forecast = $this->updateForecast();
        }

        return $this->forecast;
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