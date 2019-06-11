<?php 

namespace App\Models;

abstract class Model
{
    public function __get($name)
    {
        return !property_exists($this, $name) ?: $this->$name;
    }

    public function __isset($name)
    {
        return property_exists($this, $name) ? true : false;
    }
}