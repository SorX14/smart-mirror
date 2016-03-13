<?php
/**
 * User: stephen.parker
 * Date: 13/03/2016
 * Time: 16:33
 */

namespace Components\Models;


class Position
{

    public $x;
    public $y;

    public function getX()
    {
        return $this->x;
    }

    public function setX($x)
    {
        $this->x = $x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function setY($y)
    {
        $this->y = $y;
    }
}