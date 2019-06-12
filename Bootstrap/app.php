<?php

session_start();

// Composer autoloading
require_once __DIR__ . '/../vendor/autoload.php';

// Environment File Initializing
try{
    $dotenv = Dotenv\Dotenv::create(base_path());
    $dotenv->load();
} catch(Dotenv\Exception\InvalidPathException $e){
    die('Cannot Find .env File');
}

require_once base_path('Bootstrap/container.php');