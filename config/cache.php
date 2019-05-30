<?php 

return [
    'views' => [
        'enabled' => $enabled = env('CACHE_VIEWS', false),
        'path' => $enabled ? base_path('cache/views') : false
    ]
];