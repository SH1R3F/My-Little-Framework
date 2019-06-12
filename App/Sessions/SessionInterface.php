<?php 

namespace App\Sessions;

interface SessionInterface
{

    public function get($key, $default = null);

    public function set($key, $value = null);

    public function clear(...$keys);

    public function exists($key);
}