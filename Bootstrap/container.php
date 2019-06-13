<?php

$container = new League\Container\Container;

// For Autowiring
$container->delegate(
    new League\Container\ReflectionContainer
);


$container->addServiceProvider(new App\Providers\ConfigServiceProvider);

// Loading Service Providers From Config/App.php
$config = $container->get(App\Config\Config::class);
foreach ($config->get('app.providers') as $provider) {
    $container->addServiceProvider(new $provider);
}

$router = $container->get(League\Route\RouteCollection::class);

require_once base_path('/App/middleware/middleware.php');
require_once base_path('/routes/web.php');

try{
    $response = $router->dispatch(
        $container->get('request'),
        $container->get('response')
    );
} catch(Exception $e) {
    $response = (new App\Exceptions\Handler(
        $e,
        $container->get(App\Sessions\SessionInterface::class)
    ))->respond();
}