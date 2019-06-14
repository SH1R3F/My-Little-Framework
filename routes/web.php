<?php 


$router->get('/', 'App\Controllers\HomeController::index')->setName('home');

$router->group('/auth', function ($router) {
    $router->get('/login', 'App\Controllers\LoginController::showLoginForm')->setName('auth.login');
    $router->post('/login', 'App\Controllers\LoginController::authenticate');
    $router->post('/logout', 'App\Controllers\LoginController::logout')->setName('auth.logout');
});