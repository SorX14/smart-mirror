<?php
/**
 * User: steve
 * Date: 15/03/16
 * Time: 08:46
 */

namespace Weather\Interfaces;


interface WeatherProviderInterface
{

    public function getWeather();

    public function updateWeather();

}