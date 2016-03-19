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
                    
                    'weather' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/weather',
                            'defaults' => [
                                'controller' => 'Api\Controller\Api',
                                'action' => 'weather',
                            ],
                        ],
                    ],
                    
                    'compliment' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/compliment',
                            'defaults' => [
                                'controller' => 'Api\Controller\Api',
                                'action' => 'compliment',
                            ],
                        ],
                    ],
                    
                    'energy' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/energy',
                            'defaults' => [
                                'controller' => 'Api\Controller\Api',
                                'action' => 'energy',
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