<?php 

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use App\Sessions\SessionInterface;

class FlashServiceProvider extends AbstractServiceProvider
{
    protected $provides = [];

    public function register()
    {
        $container = $this->getContainer();
        $container->share(Flash::class, function () use ($container) {
            return new Flash(
                $container->get(SessionInterface::class)
            );
        });
    }
}