<?php
/**
 * User: stephen.parker
 * Date: 13/03/2016
 * Time: 13:47
 */

namespace Api\Controller;


use Components\Models\Compliment;
use Components\Models\Component;
use Components\Models\Weather;
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
        // Clock - no need to update from the server
        $clock = new Component();
        $clock->setName('clock');
        $clock->setId(1);
        $clock->position->setX(0);
        $clock->position->setY(0);
        $clock->provider->setUpdateRate(1000);

        // Compliment - update every minute
        $compliment = new Component();
        $compliment->setName('compliment');
        $compliment->setId(2);
        $compliment->position->setX(0);
        $compliment->position->setY(400);
        $compliment->provider->setUpdateRate(1000);
        $compliment->provider->setUrl('/api/compliment');

        // Weather - update every minutes (but weather is internally cached)
        $weather = new Component();
        $weather->setName('weather');
        $weather->setId(3);
        $weather->position->setX(400);
        $weather->position->setY(0);
        $weather->provider->setUpdateRate(60000);
        $weather->provider->setUrl('/api/weather');

        // Energy - update every second
        $energy = new Component();
        $energy->setName('energy');
        $energy->setId(4);
        $energy->position->setX(10);
        $energy->position->setY(1000);
        $energy->provider->setUpdateRate(1000);
        $energy->provider->setUrl('/api/energy');

        return new JsonModel([
            'modules' => [
                $clock,
                $compliment,
                $weather,
                $energy,
            ],
        ]);
    }
    
    public function weatherAction() {
        $weather = new Weather(
            $this->weatherProviderInterface, 
            $this->forecastProviderInterface
        );
        
        return new JsonModel([
            'weather' => $weather
        ]);
    }

    public function complimentAction() {
        $compliments = [
            'You look great!',
            'I\'d fuck you',
            'Nice dick bro',
            'Getting swole dawg',
            'Looking like a princess'
        ];

        $compliment = new Compliment();
        $compliment->setText($compliments[rand(0, 4)]);

        return new JsonModel([
            'compliment' => $compliment
        ]);
    }

    public function energyAction() {
        return new JsonModel();
    }

}