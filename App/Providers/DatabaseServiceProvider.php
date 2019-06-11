<?php

namespace App\Providers;

use App\Config\Config;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use League\Container\ServiceProvider\AbstractServiceProvider;

class DatabaseServiceProvider extends AbstractServiceProvider
{

    protected $provides = [
        EntityManager::class
    ];

    public function register()
    {

        $container = $this->getContainer();
        $config = $container->get(Config::class);
        $container->share(EntityManager::class, function () use($config) {
            
            $db = $config->get('db.mysql');

            return EntityManager::create(
                $db,
                Setup::createAnnotationMetadataConfiguration(
                    [base_path('/app')],
                    $config->get('app.APP_DEBUG')
                )
            );
        });
    }
}