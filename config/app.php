<?php 

return [
    'name' => env('APP_NAME', false),
    'APP_DEBUG' => env('APP_DEBUG', false),


    // Registering Service Providers
    'providers' => [
        'App\Providers\AppServiceProvider',
        'App\Providers\ViewServiceProvider',
        'App\Providers\DatabaseServiceProvider',
        'App\Providers\ViewShareServiceProvider',
        'App\Providers\SessionServiceProvider'
    ],


    'middleware' => [
        'App\middleware\ShareValidationErrors',
        'App\middleware\ClearValidationErrors',
    ]

];