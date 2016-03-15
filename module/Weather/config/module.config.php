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
            'weatherUrl'    => 'api.openweathermap.org/data/2.5/weather',
            'forecastUrl'   => 'api.openweathermap.org/data/2.5/forecast',
            'cityId'        => '',
            'apiKey'        => '',
            'clientOptions' => [],
        ],
    ],

    'service_mananager' => [
        'services' => [
            'factories' => [
                'Weather/Service/OpenWeatherMapProvider' => OpenWeatherMapProviderFactory::class,
            ],
        ],
    ],
];