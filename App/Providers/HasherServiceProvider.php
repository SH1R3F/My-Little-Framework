<?php

namespace App\Providers;

use App\Hashing\BcryptHasher;
use App\Hashing\HasherInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;

class HasherServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        HasherInterface::class
    ];

    public function register()
    {
        $container = $this->getContainer();
        $container->share(HasherInterface::class, function () {
            return new BcryptHasher();
        });
    }
}