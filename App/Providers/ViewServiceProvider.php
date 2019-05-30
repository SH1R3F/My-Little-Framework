<?php 

namespace App\Providers;

use App\Views\View;
use Twig\Environment;
use App\Config\Config;
use Twig\Loader\FilesystemLoader;
use League\Container\ServiceProvider\AbstractServiceProvider;

class ViewServiceProvider extends AbstractServiceProvider
{

    protected $provides = [
        View::class
    ];


    public function register()
    {
        
        $container = $this->getContainer();
        $config = $container->get(Config::class);

        $container->share(View::class, function() use($config) {

            $loader = new FilesystemLoader(base_path('views'));
            $twig = new Environment($loader, [
                'cache' => $config->get('cache.views.path')
            ]);

            return new View($twig);

        });
    }

}