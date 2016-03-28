<?php
/**
 * User: stephen.parker
 * Date: 13/03/2016
 * Time: 16:12
 */

namespace Components\Models\Abstracts;


use Components\Models\Interfaces\ComponentInterface;
use Components\Models\Position;
use Components\Models\Provider;

abstract class ComponentAbstract 
{
    /**
     * @var string Class name
     */
    public $name;

    /**
     * @var string Title of the module
     */
    public $title;

    /**
     * @var integer
     */
    public $id;

    /**
     * @var Provider
     */
    public $provider;

    public function __construct()
    {
        $this->provider = new Provider();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
}