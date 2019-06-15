<?php 

return [
    'name' => env('APP_NAME', false),
    'APP_DEBUG' => env('APP_DEBUG', false),


    // Registering Service Providers
    'providers' => [
        'App\Providers\AppServiceProvider',
        'App\Providers\ViewServiceProvider',
        'App\Providers\DatabaseServiceProvider',
        'App\Providers\SessionServiceProvider',
        'App\Providers\HasherServiceProvider',
        'App\Providers\AuthServiceProvider',
        'App\Providers\FlashServiceProvider',
        'App\Providers\CsrfServiceProvider',
        'App\Providers\ValidationRuleServicePovider',
        'App\Providers\CookieServiceProvider',
        'App\Providers\ViewShareServiceProvider'
    ],


    'middleware' => [
        'App\middleware\ShareValidationErrors',
        'App\middleware\ClearValidationErrors',
        'App\middleware\Authenticate',
        'App\middleware\CsrfGuard',
        'App\middleware\AuthenticateFromCookies'
    ]

];