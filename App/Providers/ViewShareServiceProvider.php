<?php

namespace App\Providers;

use App\Auth\Auth;
use App\Views\View;
use App\Config\Config;
use App\Sessions\Flash;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class ViewShareServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function boot()
    {
        $container = $this->getContainer();
        $container->get(View::class)->share([
            'config' => $container->get(Config::class),
            'auth'   => $container->get(Auth::class),
            'flash'  => $container->get(Flash::class)
        ]);
    }

    public function register()
    {
        
    }
}