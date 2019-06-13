<?php

namespace App\Sessions;

use App\Sessions\SessionInterface;

class Session implements SessionInterface
{
    public function get($key, $default = null)
    {
        return $this->exists($key) ? $_SESSION[$key] : $default;
    }

    public function set($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $name => $value) {
                $_SESSION[$name] = $value;
            }
            return;
        }
        $_SESSION[$key] = $value;
    }

    public function clear(...$keys)
    {
        foreach ($keys as $key) {
            unset($_SESSION[$key]);
        }
    }

    public function exists($key)
    {
        return isset($_SESSION[$key]) && !empty($_SESSION[$key]);
    }
}