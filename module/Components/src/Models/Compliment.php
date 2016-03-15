<?php
/**
 * User: stephen.parker
 * Date: 13/03/2016
 * Time: 18:34
 */

namespace Components\Models;


use Components\Models\Abstracts\ComponentAbstract;

class Compliment extends ComponentAbstract
{

    /**
     * @var string
     */
    public $text;

    public function __construct()
    {
        parent::__construct();

        $this->text = 'String: ' . rand(0, 1000);
    }
}