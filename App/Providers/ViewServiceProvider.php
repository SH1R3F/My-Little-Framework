<?php 

namespace App\Providers;

use App\Views\View;
use Twig\Environment;
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

        $container->share(View::class, function(){

            $loader = new FilesystemLoader(base_path('views'));
            $twig = new Environment($loader, [
                'cache' => false,
            ]);

            return new View($twig);

        });
    }

}