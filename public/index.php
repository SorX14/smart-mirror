<?php
/**
 * User: stephen.parker
 * Date: 12/03/2016
 * Time: 14:48
 */

chdir(dirname(__DIR__));

require 'vendor/autoload.php';

Zend\Mvc\Application::init(require 'config/application.config.php')->run();