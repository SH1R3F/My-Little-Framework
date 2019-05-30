<?php 

namespace App\Config;

use App\Config\Loaders\LoaderInterface;


class Config
{
    private $_config = [];
    private $_cache = [];

    public function load(array $loaders)
    {

        foreach ($loaders as $loader) {
            if ($loader instanceof LoaderInterface) {
                $this->_config = array_merge($this->_config, $loader->parse());
            }
        }

        return $this;

    }

    public function get($key)
    {
        // Get it from cache if exists
        if ($this->existsInCache($key)) {
            return $this->fromCache($key);
        }

        // Otherwise get it from config and set in cache
        return $this->setInCache(
            $key, 
            $this->extractFromConfig($key)
        );

    }

    private function extractFromConfig($key)
    {
        $segments = explode('.', $key);
        $filtered = $this->_config;
        foreach ($segments as $segment) {
            if (array_key_exists($segment, $filtered)) {
                $filtered = $filtered[$segment];
            }
        }
        return $filtered;
    }
    
    private function existsInCache($key)
    {
        return isset($this->_cache[$key]);
    }

    private function fromCache($key)
    {
        return $this->_cache[$key];
    }

    private function setInCache($key, $value)
    {
        $this->_cache[$key] = $value;
        return $value;
    }

}