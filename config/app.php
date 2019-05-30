<?php 

return [
    'APP_NAME' => 'My Little Framework',
    'APP_DEBUG' => env('APP_DEBUG', false),


    // Registering Service Providers
    'providers' => [
        'App\Providers\AppServiceProvider',
        'App\Providers\ViewServiceProvider'
    ]


];