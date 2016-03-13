<?php
/**
 * User: stephen.parker
 * Date: 12/03/2016
 * Time: 14:56
 */

use Application\Controller\Factory\IndexControllerFactory;
use Application\Service\Factory\CommentsServiceFactory;

return [
    'router' => [
        'routes' => [
            'home'           => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ],
                ],
            ],
            'phpinfo'        => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/phpinfo',
                    'defaults' => [
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'phpinfo',
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            'Application\Controller\Index' => IndexControllerFactory::class,
        ],
    ],

    'service_manager' => [
        'factories' => [
            'Application\Service\Comments' => CommentsServiceFactory::class,
        ],
    ],

    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map'             => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'     => __DIR__ . '/../view/error/404.phtml',
            'error/index'   => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack'      => [
            __DIR__ . '/../view',
        ],
        'strategies'               => [
            'ViewJsonStrategy',
        ],
    ],
];