<?php

namespace App\Providers;

use App\Config\Config;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Illuminate\Database\Capsule\Manager as Capsule;

class DatabaseServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    public function boot()
    {
        $container = $this->getContainer();
        $config = $container->get(Config::class);

        $capsule = new Capsule();
        $capsule->addConnection($config->get('db.mysql'));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        
    }

    public function register()
    {
        //
    }
}