<?php
/**
 * User: steve
 * Date: 15/03/16
 * Time: 09:01
 */

namespace Weather\Interfaces;


interface ForecastProviderInterface
{

    public function getForecast();

    public function updateForecast();

}