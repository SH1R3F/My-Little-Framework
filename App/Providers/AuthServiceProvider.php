<?php

namespace App\Providers;

use App\Auth\Auth;
use App\Cookies\Cookie;
use App\Auth\RememberMe;
use App\Hashing\HasherInterface;
use App\Sessions\SessionInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;

class AuthServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        Auth::class
    ];

    public function register()
    {
        $container = $this->getContainer();
        $container->share(Auth::class, function () use ($container) {
            return new Auth(
                $container->get(SessionInterface::class),
                $container->get(HasherInterface::class),
                (new RememberMe()),
                $container->get(Cookie::class)
            );
        });
    }
}