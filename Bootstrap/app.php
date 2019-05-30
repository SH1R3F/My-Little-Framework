<?php

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

// Composer autoloading
require_once __DIR__ . '/../vendor/autoload.php';

// Environment File Initializing
try{
    $dotenv = Dotenv::create(base_path());
    $dotenv->load();
} catch(InvalidPathException $e){
    die('Cannot Find .env File');
}

require_once base_path('Bootstrap/container.php');