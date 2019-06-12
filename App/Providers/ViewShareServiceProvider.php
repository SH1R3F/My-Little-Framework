<?php

namespace App\Providers;

use App\Views\View;
use App\Config\Config;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class ViewShareServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function boot()
    {
        $container = $this->getContainer();
        $container->get(View::class)->share([
            'config' => $container->get(Config::class)
        ]);
    }

    public function register()
    {
        
    }
}