<?php
/**
 * User: stephen.parker
 * Date: 12/03/2016
 * Time: 19:37
 */

namespace Redis\Service\Factory;


use Zend\Cache\Storage\Adapter\Redis;
use Zend\Cache\Storage\Adapter\RedisOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RedisFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return Redis
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $config = $config['redis'];

        $redisOptions = new RedisOptions();
        $redisOptions->setServer([
            'host'    => $config['host'],
            'port'    => $config['port'],
            'timeout' => 30,
        ]);

        $redisOptions->setLibOptions([
            \Redis::OPT_SERIALIZER => \Redis::SERIALIZER_PHP,
        ]);

        return new Redis($redisOptions);
    }
}