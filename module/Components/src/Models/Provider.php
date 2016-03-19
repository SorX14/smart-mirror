<?php
/**
 * User: Steve
 * Date: 19/03/2016
 * Time: 17:11
 */

namespace Components\Models;


class Provider
{

    /**
     * URL to update from
     *
     * @var string
     */
    public $url;

    /**
     * Milliseconds between update
     *
     * @var int
     */
    public $updateRate;

    public function __construct() {
        $this->updateRate = 1000;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return int
     */
    public function getUpdateRate()
    {
        return $this->updateRate;
    }

    /**
     * @param int $updateRate
     */
    public function setUpdateRate($updateRate)
    {
        $this->updateRate = $updateRate;
    }
}