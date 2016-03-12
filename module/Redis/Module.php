<?php
/**
 * User: stephen.parker
 * Date: 12/03/2016
 * Time: 19:32
 */

namespace Redis;

class Module
{
    public function getConfig()
    {
        return require __DIR__ . '/config/module.config.php';
    }
}