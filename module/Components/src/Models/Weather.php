<?php
/**
 * User: steve
 * Date: 15/03/16
 * Time: 08:44
 */

namespace Components\Models;


use Components\Models\Abstracts\ComponentAbstract;
use Weather\Interfaces\ForecastProviderInterface;
use Weather\Interfaces\WeatherProviderInterface;

class Weather extends ComponentAbstract
{

    public $weather;
    public $forecast;
    /**
     * @var \Weather\Interfaces\WeatherProviderInterface
     */
    protected $weatherProviderInterface;
    /**
     * @var \Weather\Interfaces\ForecastProviderInterface
     */
    protected $forecastProviderInterface;

    public function __construct(
        WeatherProviderInterface $weatherProviderInterface,
        ForecastProviderInterface $forecastProviderInterface
    )
    {
        parent::__construct();

        $this->weatherProviderInterface = $weatherProviderInterface;
        $this->forecastProviderInterface = $forecastProviderInterface;

        try {
            $this->weather = $this->weatherProviderInterface->getWeather();
            $this->forecast = $this->forecastProviderInterface->getForecast();
        } catch (\Exception $e) {

        }
    }
}