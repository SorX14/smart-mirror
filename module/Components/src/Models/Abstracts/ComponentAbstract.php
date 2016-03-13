<?php
/**
 * User: stephen.parker
 * Date: 13/03/2016
 * Time: 16:12
 */

namespace Components\Models\Abstracts;


use Components\Models\Position;
use ReflectionClass;

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
     * @var Position
     */
    public $position;

    public function __construct()
    {
        $reflect = new ReflectionClass($this);
        $this->name = $reflect->getShortName();
        $this->position = new Position();
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
}