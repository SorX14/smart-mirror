<?php
/**
 * User: stephen.parker
 * Date: 13/03/2016
 * Time: 13:47
 */

namespace Api\Controller;


use Components\Models\Component;
use Psr\Log\LoggerInterface;
use Weather\Interfaces\ForecastProviderInterface;
use Weather\Interfaces\WeatherProviderInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController
{

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var \Weather\Interfaces\WeatherProviderInterface
     */
    protected $weatherProviderInterface;

    /**
     * @var \Weather\Interfaces\ForecastProviderInterface
     */
    protected $forecastProviderInterface;

    public function __construct(
        LoggerInterface $logger,
        WeatherProviderInterface $weatherProviderInterface,
        ForecastProviderInterface $forecastProviderInterface
    )
    {
        $this->logger = $logger;
        $this->weatherProviderInterface = $weatherProviderInterface;
        $this->forecastProviderInterface = $forecastProviderInterface;
    }

    public function layoutAction()
    {
        $clock = new Component();
        $clock->setName('clock');
        $clock->setId(1);
        $clock->position->setX(0);
        $clock->position->setY(0);

        $compliment = new Component();
        $compliment->setName('compliment');
        $compliment->setId(2);
        $compliment->position->setX(100);
        $compliment->position->setY(400);

        $weather = new Component();
        $weather->setName('weather');
        $weather->setId(3);
        $weather->position->setX(400);
        $weather->position->setY(0);

        return new JsonModel([
            'modules' => [
                $clock,
                $compliment,
                $weather,
            ],
        ]);
    }

}