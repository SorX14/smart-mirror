<?php
/**
 * User: stephen.parker
 * Date: 12/03/2016
 * Time: 14:50
 */

return [
    'modules' => [
        'Application',
        'Redis',
        'Api',

        'EnliteMonolog',
    ],

    'module_listener_options' => [
        'module_paths' => [
            './module',
            './vendor',
        ],

        'config_glob_paths' => [
            'config/autoload/{{,*.}global,{,*.}local}.php',
        ],
    ],
];