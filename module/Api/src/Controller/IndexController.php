<?php
/**
 * User: stephen.parker
 * Date: 13/03/2016
 * Time: 13:47
 */

namespace Api\Controller;


use Components\Models\Clock;
use Components\Models\Compliment;
use Psr\Log\LoggerInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController
{

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function layoutAction()
    {
        $this->logger->info('INFO EXAMPLE');
        $this->logger->error('ERROR EXAMPLE', ['else' => 'cheese']);

        $clock = new Clock();
        $clock->setTitle('Clock');
        $clock->setId(1);
        $clock->position->setX(0);
        $clock->position->setY(0);

        $compliment = new Compliment();
        $compliment->setTitle('Complimenttuna');
        $compliment->setId(2);
        $compliment->position->setX(100);
        $compliment->position->setY(400);

        return new JsonModel([
            'modules' => [
                $clock,
                $compliment,
            ],
        ]);
    }

}