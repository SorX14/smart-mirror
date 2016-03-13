<?php
/**
 * User: stephen.parker
 * Date: 13/03/2016
 * Time: 13:57
 */

namespace Api\Controller\Factory;


use Api\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface
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
        $logger = $serviceLocator->getServiceLocator()->get('EnliteMonologService');

        $service = new IndexController($logger);

        return $service;
    }
}