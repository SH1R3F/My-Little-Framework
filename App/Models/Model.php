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

    public function update(array $data)
    {
        foreach ($data as $column => $value) {
            $this->$column = $value;
        }
    }

    public function fill(array $data)
    {
        $this->update($data);
    }
}