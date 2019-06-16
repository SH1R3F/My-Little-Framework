<?php

namespace App\Providers;

use App\Views\View;
use App\Views\ViewPaginatorFactory;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class PaginateServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    public function boot()
    {
        $container = $this->getContainer();
        

        LengthAwarePaginator::viewFactoryResolver(function () use ($container) {
            return new ViewPaginatorFactory($container->get(View::class));
        });

        LengthAwarePaginator::defaultView('pagination/_bootstrap.twig');

        $request = $container->get('request');

        LengthAwarePaginator::currentPageResolver(function () use ($request) {
            return $request->getQueryParams()['page'] ?? 1;
        });

        LengthAwarePaginator::currentPathResolver(function () use ($request) {
            return $request->getUri()->getPath();
        });
        


    }

    public function register()
    {
        //
    }

}