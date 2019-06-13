<?php 

namespace App\Providers;

use App\Views\View;
use Twig\Environment;
use App\Config\Config;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;
use App\Views\Extensions\PathExtension;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Route\RouteCollection;

class ViewServiceProvider extends AbstractServiceProvider
{

    protected $provides = [
        View::class
    ];


    public function register()
    {
        
        $container = $this->getContainer();
        $config = $container->get(Config::class);

        $container->share(View::class, function() use($config, $container) {

            $loader = new FilesystemLoader(base_path('views'));
            $twig = new Environment($loader, [
                'cache' => $config->get('cache.views.path'),
                'debug' => $config->get('app.APP_DEBUG')
            ]);

            if ($config->get('app.APP_DEBUG')) {
                $twig->addExtension(new DebugExtension());
            }
            $twig->addExtension(new PathExtension($container->get(RouteCollection::class)));

            return new View($twig);

        });
    }

}