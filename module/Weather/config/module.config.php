<?php
/**
 * User: steve
 * Date: 15/03/16
 * Time: 08:39
 */

use Weather\Hydrators\OpenWeatherMap\Factories\CityHydratorFactory;
use Weather\Hydrators\OpenWeatherMap\Factories\ForecastHydratorFactory;
use Weather\Hydrators\OpenWeatherMap\Factories\WeatherHydratorFactory;
use Weather\Hydrators\OpenWeatherMap\Factories\WeatherItemHydratorFactory;
use Weather\Hydrators\OpenWeatherMap\GpsCoordinatesHydrator;
use Weather\Service\Factories\OpenWeatherMapProviderFactory;

return [
    'weather' => [
        'openWeatherMap' => [
            'weatherUrl'    => 'http://api.openweathermap.org/data/2.5/weather',
            'forecastUrl'   => 'http://api.openweathermap.org/data/2.5/forecast/daily',
            'units'         => 'metric',
            'cityId'        => '',
            'apiKey'        => '',
            'clientOptions' => [],
        ],
    ],

    'service_manager' => [
        'factories'  => [
            'Weather/Service/OpenWeatherMapProvider'               => OpenWeatherMapProviderFactory::class,
            'Weather/Hydrators/OpenWeatherMap/WeatherItemHydrator' => WeatherItemHydratorFactory::class,
            'Weather/Hydrators/OpenWeatherMap/WeatherHydrator'     => WeatherHydratorFactory::class,
            'Weather/Hydrators/OpenWeatherMap/CityHydrator'        => CityHydratorFactory::class,
            'Weather/Hydrators/OpenWeatherMap/ForecastHydrator'    => ForecastHydratorFactory::class,
        ],
        'invokables' => [
            'Weather/Hydrators/OpenWeatherMap/GpsCoordinatesHydrator' => GpsCoordinatesHydrator::class,
        ],
    ],
];