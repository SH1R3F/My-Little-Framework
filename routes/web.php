<?php 


$router->get('/', function($request, $response){
    $response->getBody()->write('Hello From Routes');
    return $response;
});