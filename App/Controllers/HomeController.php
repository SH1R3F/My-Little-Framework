<?php 
namespace App\Controllers;

class HomeController
{

    public function index($request, $response)
    {
        $response->getBody()->write('Hello From Home Controller');
        return $response;
    }

}