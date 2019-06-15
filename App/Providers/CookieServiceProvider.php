<?php

namespace App\Providers;

use App\Cookies\Cookie;
use League\Container\ServiceProvider\AbstractServiceProvider;

class CookieServiceProvider extends AbstractServiceProvider
{

    protected $provides = [];

    public function register()
    {
        $container = $this->getContainer();

        $container->share(Cookie::Class, function () {
            return new Cookie();
        });
    }
}