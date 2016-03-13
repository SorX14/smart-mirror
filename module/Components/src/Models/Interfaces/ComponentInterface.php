<?php
/**
 * User: stephen.parker
 * Date: 13/03/2016
 * Time: 14:19
 */

namespace Components\Models\Interfaces;


interface ComponentInterface
{

    public function setId($id);

    public function getId();

    public function setTitle($title);

    public function getTitle();

    public function getName();
}