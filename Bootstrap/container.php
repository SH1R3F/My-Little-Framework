<?php 

use League\Container\Container;
use League\Route\RouteCollection;
use App\Providers\AppServiceProvider;
use League\Route\Http\Exception\NotFoundException;
use League\Container\ReflectionContainer;
use App\Providers\ViewServiceProvider;

$container = new Container;

// For Autowiring
$container->delegate(
    new ReflectionContainer
);

$container->addServiceProvider(new AppServiceProvider);
$container->addServiceProvider(new ViewServiceProvider);

$router = $container->get(RouteCollection::class);

require_once __DIR__ . '/../routes/web.php';

try{
    $response = $router->dispatch(
        $container->get('request'),
        $container->get('response')
    );
} catch(NotFoundException $e) {
    // Route does not exist.
    die('404 not found');
}