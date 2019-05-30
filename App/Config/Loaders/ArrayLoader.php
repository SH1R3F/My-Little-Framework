<?php 

namespace App\Config\Loaders;

use App\Config\Loaders\LoaderInterface;

class ArrayLoader implements LoaderInterface
{
 
    protected $files = [];

    public function __construct($files)
    {
        $this->files = $files;
    }

    public function parse()
    {
        $parsed = [];
        foreach ($this->files as $name => $path) {
            if (file_exists($path)) {
                $parsed[$name] = require_once $path;
            }
        }
        return $parsed;
    }

}