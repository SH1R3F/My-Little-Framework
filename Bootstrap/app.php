<?php

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

// Composer autoloading
require_once __DIR__ . '/../vendor/autoload.php';


// Environment File Initializing
try{
    $dotenv = Dotenv::create(__DIR__ . '/../');
    $dotenv->load();
} catch(InvalidPathException $e){
    die('Cannot Find .env File');
}

require_once __DIR__ . '/container.php';