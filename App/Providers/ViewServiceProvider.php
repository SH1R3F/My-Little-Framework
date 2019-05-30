<?php 

namespace App\Providers;

use App\Views\View;
use Twig\Environment;
use App\Config\Config;
use Twig\Loader\FilesystemLoader;
use League\Container\ServiceProvider\AbstractServiceProvider;
use Twig\Extension\DebugExtension;

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
                'cache' => $config->get('cache.views.path'),
                'debug' => $config->get('app.APP_DEBUG')
            ]);

            if ($config->get('app.APP_DEBUG')) { // This time will be loaded from config cache
                $twig->addExtension(new DebugExtension());
            }

            return new View($twig);

        });
    }

}