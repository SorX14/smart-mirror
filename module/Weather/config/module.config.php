<?php
/**
 * User: steve
 * Date: 15/03/16
 * Time: 08:39
 */

use Weather\Service\Factories\OpenWeatherMapProviderFactory;

return [
    'weather' => [
        'openWeatherMap' => [
            'weatherUrl'    => 'http://api.openweathermap.org/data/2.5/weather',
            'forecastUrl'   => 'http://api.openweathermap.org/data/2.5/forecast',
            'units'         => '',
            'cityId'        => '',
            'apiKey'        => '',
            'clientOptions' => [],
        ],
    ],

    'service_manager' => [
        'factories' => [
            'Weather/Service/OpenWeatherMapProvider' => OpenWeatherMapProviderFactory::class,
        ],
    ],
];