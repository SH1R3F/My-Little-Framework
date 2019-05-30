<?php 

use App\Config\Config;
use League\Container\Container;
use League\Route\RouteCollection;
use App\Providers\AppServiceProvider;
use App\Providers\ViewServiceProvider;
use App\Providers\ConfigServiceProvider;
use League\Container\ReflectionContainer;
use League\Route\Http\Exception\NotFoundException;

$container = new Container;

// For Autowiring
$container->delegate(
    new ReflectionContainer
);

$container->addServiceProvider(new AppServiceProvider);
$container->addServiceProvider(new ViewServiceProvider);
$container->addServiceProvider(new ConfigServiceProvider);

$router = $container->get(RouteCollection::class);

require_once base_path('/routes/web.php');

try{
    $response = $router->dispatch(
        $container->get('request'),
        $container->get('response')
    );
} catch(NotFoundException $e) {
    // Route does not exist.
    die('404 not found');
}