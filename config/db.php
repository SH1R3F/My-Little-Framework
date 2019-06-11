<?php 

return [
    'mysql' => [
        'driver'    => env('DB_CONNECTION'),
        'host'      => env('DB_HOST'),
        'dbname'    => env('DB_DATABASE'),
        'user'      => env('DB_USERNAME'),
        'password'  => env('DB_PASSWORD'),
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ]
];