<?php

namespace App\Providers;

use App\Security\Csrf;
use League\Container\ServiceProvider\AbstractServiceProvider;
use App\Sessions\SessionInterface;

class CsrfServiceProvider extends AbstractServiceProvider
{
 
    protected $provides = [
        Csrf::class
    ];

    public function register()
    {
        $container = $this->getContainer();
        $container->share(Csrf::class, function () use ($container) {
            return new Csrf($container->get(SessionInterface::class));
        });
    }

}