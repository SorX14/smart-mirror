<?php
/**
 * User: steve
 * Date: 16/03/16
 * Time: 08:29
 */

namespace Weather\Models;


class Clouds
{

    /**
     * Value
     *
     * @var string
     */
    public $value;

    /**
     * Name of the cloudiness
     *
     * @var string
     */
    public $name;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}