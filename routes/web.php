<?php 


$router->get('/', 'App\Controllers\HomeController::index')->setName('home');

$router->group('/auth', function ($router) {

    $router->get('/login', 'App\Controllers\Auth\LoginController::showLoginForm')->setName('auth.login');
    $router->post('/login', 'App\Controllers\Auth\LoginController::authenticate');

    $router->post('/logout', 'App\Controllers\Auth\LoginController::logout')->setName('auth.logout');

    $router->get('/register', 'App\Controllers\Auth\RegisterController::showRegisterationForm')->setName('auth.register');
    $router->post('/register', 'App\Controllers\Auth\RegisterController::register');

});