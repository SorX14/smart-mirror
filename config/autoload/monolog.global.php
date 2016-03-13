<?php
/**
 * User: stephen.parker
 * Date: 12/03/2016
 * Time: 21:34
 */

return [
    'EnliteMonolog' => [
        'EnliteMonologService' => [
            'handlers' => [
                'default' => [
                    'name'      => 'Monolog\Handler\StreamHandler',
                    'args'      => [
                        'path'   => 'data/log/application.log',
                        'level'  => \Monolog\Logger::DEBUG,
                        'bubble' => true,
                    ],
                    'formatter' => [
                        'name' => 'Monolog\Formatter\LogstashFormatter',
                        'args' => [
                            'application' => 'Smart Mirror',
                        ],
                    ],
                ],
            ],
        ],
    ],
];