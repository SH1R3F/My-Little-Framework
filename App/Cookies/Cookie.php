<?php 

namespace App\Cookies;

class Cookie
{

    private $path = '/';
    private $domain = null;
    private $secure = false;
    private $httpOnly = true;

    public function set($key, $value, $minutes)
    {
        $expiry = time() + ($minutes * 60);
        setcookie(
            $key, $value, $expiry,
            $this->path, $this->domain, $this->secure, $this->httpOnly
        );
    }

    public function get($key, $default = null)
    {
        if ($this->exists($key)) {
            return $_COOKIE[$key];
        }

        return $default;
    }

    public function exists($key)
    {
        return isset($_COOKIE[$key]) && !empty($_COOKIE[$key]);
    }

    public function clear($key)
    {
        $this->set($key, null, -2628000);
    }

    public function forever($key, $value)
    {
        $this->set($key, null, 2628000);
    }
}