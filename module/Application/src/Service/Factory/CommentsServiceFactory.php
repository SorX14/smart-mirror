<?php
/**
 * User: stephen.parker
 * Date: 12/03/2016
 * Time: 20:01
 */

namespace Application\Service\Factory;


use Application\Service\CommentsService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CommentsServiceFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $storageAdapter = $serviceLocator->get('Redis\Cache\Redis');

        $service = new CommentsService($storageAdapter);

        return $service;
    }

}