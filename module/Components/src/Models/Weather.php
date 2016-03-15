<?php
/**
 * User: steve
 * Date: 15/03/16
 * Time: 08:44
 */

namespace Components\Models;


use Components\Models\Abstracts\ComponentAbstract;
use Weather\Interfaces\WeatherProviderInterface;

class Weather extends ComponentAbstract
{

    /**
     * @var \Weather\Interfaces\WeatherProviderInterface
     */
    protected $weatherProviderInterface;

    public function __construct(WeatherProviderInterface $weatherProviderInterface)
    {
        parent::__construct();

        $this->weatherProviderInterface = $weatherProviderInterface;
    }


}