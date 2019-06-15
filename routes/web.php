<?php

$router->get('/', 'App\Controllers\HomeController::index')->setName('home');

$router->get('/dashboard', 'App\Controllers\HomeController::dashboard')->setName('dashboard')->middleware($container->get(App\middleware\Authenticated::class));


$router->group('/auth', function ($router) use ($container) {

    $router->get('/login', 'App\Controllers\Auth\LoginController::showLoginForm')->setName('auth.login')->middleware($container->get(App\middleware\Guest::class));
    $router->post('/login', 'App\Controllers\Auth\LoginController::authenticate')->middleware($container->get(App\middleware\Guest::class));

    $router->post('/logout', 'App\Controllers\Auth\LoginController::logout')->setName('auth.logout')->middleware($container->get(App\middleware\Authenticated::class));

    $router->get('/register', 'App\Controllers\Auth\RegisterController::showRegisterationForm')->setName('auth.register')->middleware($container->get(App\middleware\Guest::class));
    $router->post('/register', 'App\Controllers\Auth\RegisterController::register')->middleware($container->get(App\middleware\Guest::class));

});