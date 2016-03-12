<?php
/**
 * User: stephen.parker
 * Date: 12/03/2016
 * Time: 15:29
 */

namespace Application\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }
}