<?php 
namespace App\Providers;

use Zend\Diactoros\Response;
use League\Route\RouteCollection;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Container\ServiceProvider\AbstractServiceProvider;

class AppServiceProvider extends AbstractServiceProvider
{

    protected $provides = [
        RouteCollection::class,
        'response',
        'request',
        'emitter'
    ];

    public function register()
    {

        $container = $this->getContainer();

        // Router
        $container->share(RouteCollection::class, function() use ($container){
            return new RouteCollection($container);
        });

        // Response
        $container->share('response', Response::class);

        // Request
        $container->share('request', ServerRequestFactory::fromGlobals(
            $_SERVER,
            $_GET,
            $_POST,
            $_COOKIE,
            $_FILES
        ));

        // emitter
        $container->share('emitter', SapiEmitter::class);

    }
}