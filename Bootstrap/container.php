<?php 

use League\Container\Container;
use App\Providers\AppServiceProvider;


$container = new Container;
$container->addServiceProvider(AppServiceProvider);