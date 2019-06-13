<?php 


foreach ($config->get('app.middleware') as $middleware) {
    $router->middleware($container->get($middleware));
}