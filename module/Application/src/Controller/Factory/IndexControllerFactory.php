<?php
/**
 * User: stephen.parker
 * Date: 12/03/2016
 * Time: 19:40
 */

namespace Application\Controller\Factory;


use Application\Controller\IndexController;
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
        $commentsService = $serviceLocator->getServiceLocator()->get('Application\Service\Comments');

        $service = new IndexController($commentsService);

        return $service;
    }
}