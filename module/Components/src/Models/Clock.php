<?php
/**
 * User: stephen.parker
 * Date: 13/03/2016
 * Time: 14:18
 */

namespace Components\Models;


use Components\Models\Abstracts\ComponentAbstract;
use Components\Models\Interfaces\ComponentInterface;

class Clock extends ComponentAbstract implements ComponentInterface
{

    /**
     * @var string
     */
    public $dateFormat = 'dddd, D MMMM YYYY';
    /**
     * @var string
     */
    public $timeFormat = 'HH:mm';

    public function __construct()
    {
        parent::__construct();
    }

}