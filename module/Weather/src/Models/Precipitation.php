<?php
/**
 * User: steve
 * Date: 16/03/16
 * Time: 08:33
 */

namespace Weather\Models;


class Precipitation
{

    /**
     * Precipitation, mm
     *
     * @var float
     */
    public $value;

    /**
     * Possible values are 'no', name of weather phenomena as 'rain', 'snow'
     *
     * @var string
     */
    public $mode;

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param string $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }


}