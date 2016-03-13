<?php
/**
 * User: stephen.parker
 * Date: 13/03/2016
 * Time: 13:45
 */

use Api\Controller\Factory\IndexControllerFactory;

return [
    'router' => [
        'routes' => [
            'api' => [
                'type'          => 'Literal',
                'options'       => [
                    'route' => '/api',
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'layout' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/layout',
                            'defaults' => [
                                'controller' => 'Api\Controller\Api',
                                'action'     => 'layout',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            'Api\Controller\Api' => IndexControllerFactory::class,
        ],
    ],

    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];