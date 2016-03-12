<?php
/**
 * User: stephen.parker
 * Date: 12/03/2016
 * Time: 19:33
 */

use Redis\Service\Factory\RedisFactory;

return [
    'redis'           => [
        'host' => 'localhost',
        'port' => 6379,
    ],
    'service_manager' => [
        'factories' => [
            'Redis\Cache\Redis' => RedisFactory::class,
        ],
    ],
];