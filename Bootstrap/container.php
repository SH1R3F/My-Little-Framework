<?php 

use League\Container\Container;
use League\Route\RouteCollection;
use App\Providers\AppServiceProvider;
use League\Route\Http\Exception\NotFoundException;

$container = new Container;
$container->addServiceProvider(new AppServiceProvider);

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