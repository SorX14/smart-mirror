<?php
/**
 * User: stephen.parker
 * Date: 13/03/2016
 * Time: 13:45
 */

namespace Api;

class Module
{
    public function getConfig()
    {
        return require __DIR__ . '/config/module.config.php';
    }
}