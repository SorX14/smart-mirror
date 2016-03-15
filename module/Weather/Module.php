<?php
/**
 * User: steve
 * Date: 15/03/16
 * Time: 08:43
 */

namespace Weather;

class Module
{
    public function getConfig()
    {
        return require __DIR__ . '/config/module.config.php';
    }
}