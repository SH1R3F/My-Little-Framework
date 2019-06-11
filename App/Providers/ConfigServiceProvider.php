<?php 

namespace App\Providers;

use App\Config\Config;
use League\Container\ServiceProvider\AbstractServiceProvider;
use App\Config\Loaders\ArrayLoader;

class ConfigServiceProvider extends AbstractServiceProvider
{

    protected $provides = [
        Config::class
    ];

    public function register()
    {
        $container = $this->getContainer();

        $container->share(Config::class, function () {
            // Array Loader
            $arrayLoader = new ArrayLoader([
                'app'   => base_path('config/app.php'),
                'cache' => base_path('config/cache.php'),
                'db' => base_path('config/db.php'),
            ]);

            return (new Config())->load([$arrayLoader]);

        });
    }

}